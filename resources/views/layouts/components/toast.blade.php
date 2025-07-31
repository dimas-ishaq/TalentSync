@if (session('toast'))
    <div class="toast position-fixed top-0 end-0 align-items-center text-bg-{{ session('toast.type') ?? 'success' }} border-0" role="alert"
        aria-live="assertive" aria-atomic="true">
        <div class="d-flex">
            <div class="toast-body">
                <span>{{session('toast.message')}}</span>
            </div>
            <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"
                aria-label="Close"></button>
        </div>
    </div>
@endif
