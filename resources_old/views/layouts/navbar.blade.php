<nav class="navbar sticky-top navbar-expand-lg navbar-dark bg-success bg-gradient">
    <div class="ms-3">
        <img src="{{ asset('assets/logos/cnat.jpeg') }}" class="logo_ageos" alt="">
    </div>
    <div class="container-fluid d-flex justify-content-center align-items-center">
        <div class="btn-group btn-group" role="group" aria-label="Basic example">
            <button type="button" class="btn btn-primary" title="Couches" id="layer_btn" onclick="openNav();"><span class="fa-solid fa-layer-group"></span> Couches</button>
            {{-- <button type="button" class="btn btn-primary disabled" title="Infos"><span class="fa-solid fa-info"></span> Info</button> --}}
            <!-- <button type="button" class="btn btn-primary" title="Recheche rapide" onclick="openNavRech()"><span class="fa-solid fa-magnifying-glass-location"></span> Recherche</button> -->
            <button type="button" class="btn btn-secondary" title="Polygone" onclick="openNavPolygone();" id="shape_btn"><span class="fa-solid fa-draw-polygon"></span> Polygone</button>
            {{-- <button type="button" class="btn btn-secondary disabled" title="Position"><span class="fa-solid fa-location-dot"></span> Point</button> --}}
            {{-- <button type="button" class="btn btn-warning disabled" title="Mesure de distance" onclick="measureDistance();"><span class="fa-solid fa-ruler"></span> Règle</button> --}}
            <!-- <button type="button" class="btn btn-warning" title="Mesure de surface" onclick="measureArea();"><span class="fa-solid fa-ruler-combined"></span></button> -->
            {{-- <button type="button" class="btn btn-danger disabled" title="Recheche rapide"><span class="fa-solid fa-trash"></span> Effacer</button> --}}
            <button type="button" class="btn btn-warning" title="Actualiser la carte" onclick="reloadPage();"><span class="fa-solid fa-refresh"></span> Actualiser la carte</button>
        </div>
    </div>
    <!-- <div class="me-3">
        <img src="{{ asset('assets/logos/ageos.png') }}" class="logo_ageos" alt="">
    </div> -->
</nav>
