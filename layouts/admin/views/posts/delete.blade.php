<div class="modal" id="confirmDeleteModal" tabindex="-1">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            <div class="modal-status bg-danger"></div>
            <form id="deleteForm" method="POST"
                action="{{ app\Core\Helpers::url('admin/posts/delete/' . $post->id) }}">
                <input type="hidden" name="id" id="id">

                <div class="modal-body text-center py-4">
                    <h3>Você tem certeza?</h3>
                    <div class="text-secondary">
                        Você tem certeza que deseja remover este Post? Essa ação não poderá ser desfeita.
                    </div>
                </div>
                <div class="modal-footer">
                    <div class="w-100">
                        <div class="row">
                            <div class="col">
                                <button type="button" class="btn w-100" data-bs-dismiss="modal"> Cancelar </button>
                            </div>
                            <div class="col">
                                <button type="submit" class="btn btn-danger w-100"> Sim, Deletar </button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
