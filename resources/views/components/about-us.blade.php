   <section class="about-section">
        <div class="container">
            <div class="row align-items-start g-4">

                <!-- About Content -->
                <div class="col-lg-8">
                    <h2>— About Us</h2>
                    <h3>About ULMCC</h3>
                    <h4>Uttarakhand Landslide Mitigation and Management Center (ULMCC)</h4>
                    <p>
                        Landslide is one of the major hazards, widely spread in hilly regions of India and accounts for
                        huge loss of lives
                        and damage to highways/roads network, human settlements, agricultural fields, and other natural
                        resources.
                        Landslides are among those hazards which have affected the Indian Territory, especially the
                        Himalayan region.
                        The Himalayan region and especially the state of Uttarakhand has a past history of several
                        landslide disaster
                        events which took heavy toll on lives and properties.
                    </p>
                    <p>
                        Therefore, it is utmost important to understand and adopt best practices that will help to
                        reduce the events of
                        landslides and minimize their effects. Considering the present landslide disaster scenario,
                        Government of
                        Uttarakhand has established the <strong>Uttarakhand Landslide Mitigation and Management
                            Center</strong> with the
                        objective to identify landslide-prone areas and provide sustainable and scientific solutions to
                        mitigate hazards.
                    </p>
                    <p>
                        The center will act as a Center of Excellence primarily in Uttarakhand and gradually extend to
                        PAN India basis.
                        Established via Government Order No. 204/XVIII-(B-2)/21-05(JDRP-AF)/2021, Dated 14.03.2022 and
                        registered under
                        Societies Registration Act 1860.
                    </p>
                </div>

                <!-- Announcements -->
                <div class="col-lg-4">
                    <div class="announcement-box">
                        <h5><i class="bi bi-megaphone-fill"></i> Announcements</h5>
                        <div class="announcement-list">
                            <ul>
                                @foreach($allNews as $news)
                                <li>
                🚨 <a href="{{ route('news.show', $news->slug) }}" class="text-decoration-none text-black">
                    {{ $news->title }}
                </a></li>
            @endforeach
                               
                            </ul>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>