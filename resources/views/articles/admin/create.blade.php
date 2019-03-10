@extends('layouts.admin')
@section('content')
	<header class="flex items-center mb-3 py-4">
		<div class="flex justify-between items-end w-full">
			<h2 class="mb-3 text-grey no-underline text-sm font-normal"> 			
			<a class="text-black no-underline" href="/articles">Articles</a> /  Create New Article</h2>
		</div>
	</header>
	<main class="lg:flex lg:flex-wrap -mx-3">
		<div class="w-full px-3 pb-6">
			<form class="w-full" action="/admin/articles" method="POST" enctype="multipart/form-data">
				@csrf
			  <div class="flex flex-wrap -mx-3 mb-6">
				    <div class="w-full px-3 mb-6">
				        <label class="block uppercase tracking-wide text-grey-darker text-xs font-bold mb-2" for="grid-title">
				        Title
				        </label>
					    <input name="title" class="appearance-none block w-full bg-grey-lighter text-grey-darker rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white {{ $errors->has('title') ? 'border border-red' : ''}}" id="grid-title" type="text">
					    @if ($errors->has('title'))
					    	<p class="text-red text-xs italic pb-4">Title is required</p>
					    @endif
				    </div>
				    <div class="w-full px-3">
					     <label class="block uppercase tracking-wide text-grey-darker text-xs font-bold mb-2" for="grid-content">
					        Content
					     </label>
					     <textarea name="content" class="appearance-none block w-full bg-grey-lighter text-grey-darker border border-grey-lighter rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-grey mb-3 {{ $errors->has('content') ? 'border border-red' : ''}}" id="grid-content" style="min-height: 200px"></textarea>
					     @if ($errors->has('content'))
					     	<p class="text-red text-xs italic pb-4">Content is required.</p>
					    @endif
				    </div>
				    <div class="w-full px-3 mb-6">
					     <label class="block uppercase tracking-wide text-grey-darker text-xs font-bold mb-2" for="grid-photo">
					        Photo
					     </label>
					     <input name="photo" class="appearance-none block w-full bg-grey-lighter text-grey-darker rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white {{ $errors->has('photo') ? 'border border-red' : ''}}" id="grid-photo" type="file">
					    @if ($errors->has('photo'))
					     	<ul class="text-red text-xs italic pb-4">
					     		@foreach($errors->get('photo') as $message)
					     			<li>{{$message}}</li>
					     		@endforeach
					     	</ul>
					    @endif
				    </div>
				    <div class="w-full px-3 mb-6">
					     <label class="block uppercase tracking-wide text-grey-darker text-xs font-bold mb-2" for="tags-grid">
					        Tags
					     </label>
					     <input name="tags" class="appearance-none block w-full bg-grey-lighter text-grey-darker rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white" id="tags-grid" type="text">
				    </div>
				    <div class="w-full px-3 mb-6">
					    <div class="flex items-center justify-start">
					      	<button class="bg-blue hover:bg-blue-dark text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" type="submit">
					        	Submit
					      	</button>
	    				</div>
    				</div>
				  </div>
			    </div>
			</form>
		</div>
	</main>
@endsection