<div class="card-block">
    <div class="row align-items-center justify-content-center">
        <div class="col-auto">
            <img class="img-fluid" src="{{ getUserProfilePicture($user->id) }}" alt="dashboard-user">
        </div>
        <div class="col">
            <h5>{{ $user->name }}</h5>
            <span><i class="fas fa-map-marker-alt f-18 m-r-5"></i>{{ $user->email }}</span>
        </div>
    </div>
</div>
