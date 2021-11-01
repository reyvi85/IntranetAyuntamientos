<div class="col-md-12">
    <nav>
        <div class="nav nav-tabs" id="nav-tab" role="tablist">
            <a class="nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-notification" role="tab" aria-controls="nav-home" aria-selected="true">Notificaciones</a>
            <a class="nav-link" id="nav-profile-tab" data-toggle="tab" href="#nav-category" role="tab" aria-controls="nav-profile" aria-selected="false">Categorías</a>
        </div>
    </nav>
    <div class="tab-content" id="nav-tabContent">
        <div class="tab-pane fade show active" id="nav-notification" role="tabpanel" aria-labelledby="nav-notification-tab">
            <a>Notificaciones</a>

        </div>

        <div class="tab-pane fade" id="nav-category" role="tabpanel" aria-labelledby="nav-category-tab">
            @livewire('notifications.category-notification-component')
        </div>
    </div>
</div>
