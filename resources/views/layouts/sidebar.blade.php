<!-- Sidebar Widgets Column -->
    <div class="col-md-4">
 
      <!-- Search Widget -->
      {{--  <div class="card my-4">
              <h5 class="card-header">Search</h5>
              <div class="card-body">
                <div class="input-group">
                  <input type="text" class="form-control" placeholder="Search for...">
                  <span class="input-group-btn">
                    <button class="btn btn-secondary" type="button">Go!</button>
                  </span>
                </div>
              </div>
            </div> 
      --}}
 
      <!-- Categories Widget -->
     <div class="card my-4">
              <h5 class="card-header">Categories</h5>
              <div>
                <ul class="list-group list-group-flush">
                  @foreach($categories as $category)
                  <li class="list-group-item"><a href="{{ route('category', $category->slug)}}">{{ $category->title }} <span class="badge badge-pill badge-secondary float-right">{{ $category->posts->count() }}</span></a></li>
                  @endforeach
                </ul>
              </div>
      </div> 

      <!-- Popular Post -->
      <div class="card my-4">
        <h5 class="card-header">Popular Posts</h5>
        <div>
          <ul class="list-group list-group-flush">
            @foreach($popularPosts as $popularPost)
            <li class="list-group-item"><img src="{{ $post->image_thumb_url }}" width=35% alt=""><a href="{{ route('blog.show', $popularPost->slug)}}">&nbsp;{{ substr($popularPost->title, 0, 20) }} ...<span class="badge badge-pill badge-secondary float-right">{{ $popularPost->view_count }} {{ str_plural('hit', $popularPost->view_count)}}</span></a></li>
            @endforeach
          </ul>
        </div>
      </div>
      
       <!-- Side Widget -->
      <div class="card my-4">
        <h5 class="card-header">Side Widget</h5>
        <div class="card-body">
          You can put anything you want inside of these side widgets. They are easy to use, and feature the new Bootstrap 4 card containers!
        </div>
      </div>
 
    </div>