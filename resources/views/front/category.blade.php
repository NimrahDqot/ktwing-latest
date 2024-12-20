@extends('front.app_front')

@section('content')

<div class="page-banner" style="background-image: url('{{ asset('uploads/page_banners/'.$blog->banner) }}')">
	<div class="page-banner-bg"></div>
	<h1>{{ CATEGORY_COLON }} {{ $category_single->category_name }}</h1>
	<nav>
		<ol class="breadcrumb justify-content-center">
			<li class="breadcrumb-item"><a href="{{ url('/') }}">{{ HOME }}</a></li>
			<li class="breadcrumb-item">{{ CATEGORY }}</li>
			<li class="breadcrumb-item active">{{ $category_single->category_name }}</li>
		</ol>
	</nav>
</div>

<div class="page-content">
	<div class="container">
		<div class="row">
			@foreach($blog_items as $row)
			<div class="col-md-4">
				<div class="blog-item">
					<div class="featured-photo">
						<a href="{{ route('front_post',$row->post_slug) }}"><img src="{{ asset('uploads/post_photos/'.$row->post_photo) }}"></a>
					</div>
					<div class="text">
						<h2>
							<a href="{{ route('front_post',$row->post_slug) }}">{{ $row->post_title }}</a>
						</h2>
						<div class="short-description">
							<p>
								{ nl2br($row->post_content_short)) !!}
							</p>
						</div>
					</div>
				</div>
			</div>
			@endforeach
			<div class="col-md-12">
                {{ $blog_items->links() }}
            </div>
		</div>
	</div>
</div>

@endsection
