<?php

namespace App;
use App\Product;
use App\Subcategory;
use App\Http\Controllers\Controller;
class Pagination extends Controller
{
	public $totall_items;
	public $per_page;
	public $current_page;
	public $totall_pages;

	public $next;
	public $previous;

    public function __construct($products, $per_page,$current_page){
    	$this->totall_items = count($products);
    	$this->per_page = $per_page;
    	$this->current_page = $current_page;
    	$this->totall_pages = ceil( $this->totall_items/$this->per_page );
    }


    public function productsPerPage($products){
    	if($this->pageNotFound()){
    		return false;
    	}
    	if($this->current_page == 1){
    		$products = array_slice($products, 0 , $this->per_page);
    	}elseif($this->current_page > 1){
    		$products = array_slice($products, (($this->current_page-1)*$this->per_page) , $this->per_page);
    	}
    	$this->next = $this->next();
    	$this->previous = $this->previous();

    	return $products;
    }

    public function next(){
    	if( $this->current_page == $this->totall_pages ){
    		return false;
    	}else{ 
    		return true; 
    	}
    }

    public function previous(){
    	if( $this->current_page == 1 ){
    		return false;
    	}else{
    		return true;
    	}
    }

    public function pageNotFound(){
    	if($this->current_page > $this->totall_pages || $this->current_page < 0){
    		return true;
    	}
    }
}
