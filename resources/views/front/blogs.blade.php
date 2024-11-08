@extends('front.app_front')

@section('content')

<div class="page-banner" style="background-image: url('{{ asset('uploads/page_banners/'.$blog->banner) }}')">
	<div class="page-banner-bg"></div>
	<h1>{{ $blog->name }}</h1>
	<nav>
		<ol class="breadcrumb justify-content-center">
			<li class="breadcrumb-item"><a href="{{ url('/') }}">{{ HOME }}</a></li>
			<li class="breadcrumb-item active">{{ $blog->name }}</li>
		</ol>
	</nav>
</div>

<div class="page-content">
	<div class="container">
		<div class="row">
			@foreach($blog_items as $row)
			<div class="col-md-4">
				<!-- <div class="blog-item">
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
				</div> -->
				<div class="blog-item">
                    <a href="{{ route('front_post',$row->post_slug) }}">
                        <img src="{{ asset('uploads/post_photos/'.$row->post_photo) }}" class="img-fluid" alt="">
                    </a>
				<div class="content">
					<span class="sub-title">{{Str::upper(str::limit($row->post_title,30))}}</span>
					<h3 class="title">{{str::limit($row->post_content_short,50)}}</h3>
					<div class="sub-content">
						<span class="authore">{{$row->authore_name}}</span>
						<span class="date">  {{date('M d, Y',strtotime($row->created_at))}}</span>
					</div>
				</div>

            </div>
			</div>
			@endforeach
		</div>
		<div class="row">
			<div class="col-md-12">
            	{{ $blog_items->links() }}
        	</div>
		</div>
	</div>
</div>

@endsection
