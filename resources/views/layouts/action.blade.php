<div class="floating-container">
    <div class="floating-button"><x-vaadin-plus /></div>
    <div class="element-container">
        <span class="float-element">
            <a id="modalPost"
                class="link-body-emphasis link-offset-2 link-underline-opacity-25 link-underline-opacity-75-hover"
                role="button" aria-haspopup="true" aria-expanded="false" data-bs-toggle="modal" data-bs-target="#newPost">
                <x-vaadin-pin-post />
            </a>
        </span>
        <span class="float-element">
            <x-antdesign-message-o />
        </span>
    </div>
</div>

<div class="modal fade" id="newPost" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Nueva publicación</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                @include('pages.post.create')
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                <button type="submit" form="nuevoPost" class="btn btn-primary">Publicar</button>
            </div>
        </div>
    </div>
</div>
