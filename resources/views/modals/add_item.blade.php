<form>
    <div class="modal fade" tabindex="-1" id="addItem">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title fw-bold">Agregar Item</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row g-4 pb-4">
                        <div class="col-12">
                            <label for="parent_id" class="form-label">Cuenta Padre
                                <span class="badge text-bg-primary" id="badge_root"></span>
                            </label>
                            <select id="parent_id" name="parent_id" class="form-select" required>

                            </select>
                        </div>
                        <div class="col-12">
                            <label for="quantity">Cantidad</label>
                            <input type="number" min="1" id="quantity" name="quantity" class="form-control" required>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="button" id="add_btn" class="btn btn-success">Agregar Item</button>
                </div>
            </div>
        </div>
    </div>
</form>