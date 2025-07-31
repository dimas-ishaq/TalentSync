<div class="d-block d-lg-none d-flex row bg-light p-1 fixed-bottom align-items-center justify-content-between">
    <div class="col d-flex align-items-center justify-content-center">
        <button class="btn btn-light" data-bs-toggle="offcanvas" data-bs-target="#bottomMenu">
            <i class="bi bi-grid-fill"></i>
        </button>
    </div>
    <div class="col d-flex align-items-center justify-content-center">
        <a href="" class="btn btn-light text-decoration-none">
            <i class="bi bi-grid-1x2-fill"></i>
        </a>
    </div>
    <div class="col d-flex align-items-center justify-content-center">
        <a href="" class="btn btn-light text-decoration-none">
            <i class="bi bi-person-circle"></i>
        </a>
    </div>
</div>
<div class="offcanvas offcanvas-start text-bg-primary" style="width: 13.125rem;" tabindex="-1" id="bottomMenu">
    <div class="offcanvas-header">
        <button type="button" class="btn-close " data-bs-dismiss="offcanvas" data-bs-target="#bottomMenu"></button>
    </div>
    <div class="offcanvas-body">
        @include('layouts.admin.sidebar-min')
    </div>
</div>
