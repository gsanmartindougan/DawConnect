<div class="floating-container">
    <div class="floating-button py-2 px-2"><x-vaadin-plus /></div>
    <div class="element-container">
        @if (auth()->user()?->student)
            <span class="float-element">
                <a id="postCreate"
                    class="link-body-emphasis link-offset-2 link-underline-opacity-25 link-underline-opacity-75-hover"
                    role="button" aria-haspopup="true" aria-expanded="false" href="{{ route('post.create') }}">
                    <x-vaadin-pin-post />
                </a>
            </span>
        @else
            <span class="float-element">
                <a id="cursoCreate"
                    class="link-body-emphasis link-offset-2 link-underline-opacity-25 link-underline-opacity-75-hover"
                    role="button" aria-haspopup="true" aria-expanded="false" href="{{ route('cursos.create') }}">
                    <x-vaadin-pin-post />
                </a>
            </span>
        @endif

        <span class="float-element">
            <x-antdesign-message-o />
        </span>
    </div>
</div>
