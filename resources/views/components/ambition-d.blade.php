 <div class="container py-5">
        <h2 class="section-title">Our Ambition and Direction</h2>
        <div class="row g-4">

            <div class="col-md-4 d-flex">
                <div class="info-card w-100">
                    <h5><i class="bi bi-globe2"></i> Vision</h5>
                    <ul>
                        <li>Act as Centre of Excellence to provide sustainable solutions for Landslide Mitigation and
                            Management.</li>
                        <li>Be a world-class center of national importance for landslide disaster mitigation to minimize
                            losses of life, property, and infrastructure.</li>
                    </ul>
                </div>
            </div>

            <div class="col-md-4 d-flex">
                <div class="info-card w-100">
                    <h5><i class="bi bi-flag-fill"></i> Mission</h5>
                    <ul>
                        <li>Research and development on spatial and temporal prediction of landslides with adaptable
                            mitigation measures.</li>
                        <li>Proper implementation of solutions for achieving safety, sustainability, resilience, and
                            comfort in hilly states.</li>
                    </ul>
                </div>
            </div>

            <div class="col-md-4 d-flex">
                <div class="info-card w-100">
                    <h5><i class="bi bi-bullseye"></i> Objectives</h5>
                    <ul>
                        <li>Adopt a holistic approach for landslide mitigation and management.</li>
                        <li>Study and analyse landslide phenomena to ensure proper mitigation works.</li>
                        <li>Identify probable landslide areas and provide consultancy.</li>
                        <li>Build capacity and knowledge sharing across India.</li>
                        <li>Collaborate with specialized bodies, research organizations, and universities.</li>
                    </ul>
                </div>
            </div>

        </div>
    </div>
    <section class="stats-section">
        <div class="container">
            <div class="row g-4 justify-content-center">

                <div class="col-md-4">
                    <div class="stat-box">
                        <i class="bi bi-trophy-fill"></i>
                        <h3 class="counter" data-target="4">0</h3>
                        <p>Projects Awarded</p>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="stat-box">
                        <i class="bi bi-stack"></i>
                        <h3 class="counter" data-target="159">0</h3>
                        <p>Detailed Project Report Evaluation</p>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="stat-box">
                        <i class="bi bi-people-fill"></i>
                        <h3 class="counter" data-target="26">0</h3>
                        <p>Conferences Attended</p>
                    </div>
                </div>

            </div>
        </div>
    </section>
     <script>
        const counters = document.querySelectorAll('.counter');
        counters.forEach(counter => {
            counter.innerText = '0';
            const updateCounter = () => {
                const target = +counter.getAttribute('data-target');
                const c = +counter.innerText;
                const increment = target / 100;
                if (c < target) {
                    counter.innerText = `${Math.ceil(c + increment)}`;
                    setTimeout(updateCounter, 20);
                } else {
                    counter.innerText = target;
                }
            };
            updateCounter();
        });
    </script>