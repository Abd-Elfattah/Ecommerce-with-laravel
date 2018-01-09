<?php

namespace App\Http\Controllers;
use App\User;
use App\Product;
use App\Rating;
use Illuminate\Http\Request;

class RatingController extends Controller
{
    public function makeRate(Request $request){
    	$input = $request->all();
    	$rating = Rating::create($input);
    	$html = '<p>Thanks For Your Feedback</p><div class="row">
			<div class="col-sm-7" style="margin-left: 0px"><hr/><div class="review-block">
					<div class="row" style="margin-left: 40px">
						<div class="col-sm-3 pull-left" style="margin-right: 30px;width: 100px">
							<div class="review-block-name" style="margin-bottom: 7px;font-size: 15px;font-weight: bold">'.User::find($rating->user_id)->firstname.' '.User::find($rating->user_id)->lastname.'</div>
							<div class="review-block-date">
							<span style="font-size: 14px">
								'.$rating->created_at->toFormattedDateString().'
								</span>
							<br/>
							'.$rating->created_at->diffForHumans().'</div>
						</div>
						<div class="col-sm-9" style="margin-top: 10px;">

							<div id="newRating" style="margin-left: 125px;margin-bottom: 15px"></div>
							<div class="review-block-description">
							<p style="padding-right: 50px;font-size: 16px">
								'. $rating->comment .'
							</p>
							</div>
						</div>
					</div>
					
				</div></div>
			</div>';
		$ratings = Rating::where('product_id',$input['product_id'])->get();
		$all_ratings=0;
		foreach ($ratings as $rating) {
			$all_ratings += $rating->rating_stars;
		}
		$count = count($ratings);
		$stars = $input['rating_stars'];
		
		$users_updated = Rating::where(['rating_stars'=>$stars,'product_id'=>$input['product_id']])->count();
		$update = [$all_ratings,$count,$users_updated];

		$data = [$html,$rating,$update];
    	return response()->json($data);
    }

    public function productRatings(Request $request){
    	$product = Product::findOrFail($request->id);
    	$ratings = Rating::where('product_id',$product->id)->orderBy('id','DESC')->get();
    	return response()->json($ratings);
    }



    public function homeRating(){
    	$all_products = Product::all();
        $all_products = Product::productsIfOutOfStock($all_products);
        $product_rating=0;
        $products_rating=[];
        foreach ($all_products as $product) {
        	foreach ($product->ratings as $rating) {
        		$product_rating += $rating->rating_stars;

        	}
        	$product_count = $product->ratings()->count();
        	if($product_count == 0){
        		$products_rating[] = [$product->id,0,0];
        	}else{
        		$product_rating = $product_rating/$product_count;
        		$products_rating[] = [$product->id,$product_rating,$product_count];
        	}
        	
        	$product_rating=0;
        	
        }
    	return response()->json($products_rating);
    }
}
