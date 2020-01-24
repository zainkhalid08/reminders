{{-- Like we see in welcome page. eg. heading with post meta at its bottom meta 1 | meta 2 | meta 3 --}}
@forelse($posts as $post)
  <div class="post-preview">
    <a href="{{ $post->seoRoute('post.show') }}">
      <h2 class="post-title">
        {!! $post->title() !!}   
      </h2>
      {{-- <h3 class="post-subtitle">
        Problems look mighty small from 150 miles up
      </h3> --}}
    </a>
    <p class="post-meta">{!! $post->meta() !!}</p>
  </div>
  <hr>
@empty
  <p>Nothing posted just yet.</p>
@endforelse
