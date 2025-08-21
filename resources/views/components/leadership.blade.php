<section class="pb-5">
    <!-- 🔹 Leadership Section -->
    <div class="container">
        <h2 class="section-title text-center mb-5">Our Leadership</h2>
        <div class="row g-4 justify-content-center">
            @foreach($allLeaders  as $leader)
                <div class="col-md-4 col-lg-2 d-flex align-items-center justify-content-center">
                    <div class="leader-card text-center w-100">
                        <div class="d-flex justify-content-center mb-3">
                            <img src="{{ asset('storage/' . $leader->image) }}" 
                                 alt="{{ $leader->name }}" 
                                 class="leader-img rounded-circle img-fluid shadow"
                                 style="max-width: 120px; height: 120px; object-fit: cover;">
                        </div>
                        <h5 class="leader-name fw-bold">{{ $leader->name }}</h5>
                        <p class="leader-role text-muted">{{ $leader->position }}</p>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>
