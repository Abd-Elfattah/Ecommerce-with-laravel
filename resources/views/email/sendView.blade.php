<p>Hello {{ " " .$user->firstname }},Thanks for using My site To activate your E-mail Click this link</p>
<a href="{{ route('sendEmailDone' , ['email' => $user->email , 'verifyToken' => $user->verifyToken]) }}">
	Click Here
</a>