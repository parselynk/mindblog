@extends('layouts.public')
@section('content')
	<header class="flex items-center mb-3 py-4">
		<div class="flex justify-between items-end w-full">
			<h2 class="mb-3 text-grey no-underline text-sm font-normal"> Articles</h2>
		</div>
	</header>
	<main class="lg:flex lg:flex-wrap -mx-3">
		@forelse($articles as $article)
			<div class="w-full px-3 pb-6">
				<div class="card lg:flex items-start flex-shrink lg:overflow-hidden" style="min-height:250px" >
					<div class="{{ $article->photos->count() ? 'lg:w-3/4' : 'w-full'}} px-3 mb-6  flex-shrink">
						<h3 class="font-normal text-xl -ml-8 mb-3 py-4 border-l-4 border-blue-light pl-6"><a href="{{ $article->path() }}" class="text-black no-underline">{{ $article->title }}</a></h3>
						<div class="text-grey">
							{{ str_limit($article->content,150, ' ...') }}
						</div>
						@if($article->tagList()->count())
							<div class="-ml-4 mt-5 py-4 pl-4 flex-shrink">
								@foreach($article->tagList() as $tag)
									<span class="inline-block bg-grey-lighter rounded-full px-3 py-1 text-sm font-semibold text-grey-darker mr-2">#{{$tag}}</span>
								@endforeach				
						   </div>
						@endif
					</div>
					@if ($article->photos->count())
						<div class="lg:w-1/4" >
							  <img class="w-full h-full rounded-lg" src="{{ asset("storage/{$article->photos->first()->name}") }}" alt="Sunset in the mountains" style="min-height:200px">
						</div>
					@endif
				</div>
			</div>
		@empty
			<div>No article.</div>
		@endforelse
	</main>
@endsection