@extends('layouts.public')
@section('content')
	<header class="flex items-center mb-3 py-4">
		<div class="flex justify-between items-end w-full">
			<h2 class="mb-3 text-grey no-underline text-sm font-normal"> 			
			<a class="text-black no-underline" href="/articles">Articles</a> /  {{ $article->title }}</h2>
		</div>
	</header>
	<main class="-mx-3">
		<div class="w-full px-3 pb-6">
			<div class="card items-start overflow-hidden">
				<div class="w-full px-3 mb-6">
					<h3 class="font-semibold text-xl -ml-8 mb-3 py-4 border-l-4 text-black no-underline border-grey-light pl-6">
						{{ $article->title }}</h3>
					@if ($article->photos->count())
						<div class="w-full py-4" >
						  <img class="w-full h-full rounded-lg" src="{{ asset("storage/{$article->photos->first()->name}") }}" style="min-height:200px">
						</div>
					@endif
					<div class="text-grey-darker py-4">
						{{ $article->content}}
					</div>
					@if($article->tagList()->count())
						<div class="-ml-4 mt-5 py-4 pl-4">
							@foreach($article->tagList() as $tag)
								<span class="inline-block bg-grey-lighter rounded-full px-3 py-1 text-sm font-semibold text-grey-darker mr-2">#{{$tag}}</span>					
							@endforeach
					    </div>
					 @endif
				</div>
			</div>
		</div>
	</main>
@endsection