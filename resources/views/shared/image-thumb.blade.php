<a href="{{ route("images.show", $image) }}" class="column is-one-quarter">
    <figure class="">
        <img src="{{ asset("/img/" . $image->file) }}" class="image">
        <figcaption>{{ $image->title }}</figcaption>
    </figure>
</a>