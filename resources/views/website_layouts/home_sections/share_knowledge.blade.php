<section class="section share-knowledge">
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <div class="knowledge-img aos" data-aos="fade-up">
                    <img src="{{ URL::asset('/build/img/share.png') }}" alt="Img" class="img-fluid">
                </div>
            </div>
            <div class="col-md-6 d-flex align-items-center">
                <div class="join-mentor aos" data-aos="fade-up">
                    <h2>{{ __("lang.share_knowledge_title") }}</h2>
                    <p>{{ __("lang.share_knowledge_description") }}</p>
                    <ul class="course-list">
                        <li><i class="fa-solid fa-circle-check"></i>{{ __("lang.best_courses") }}</li>
                        <li><i class="fa-solid fa-circle-check"></i>{{ __("lang.top_rated_teachers") }}</li>
                    </ul>
                    <div class="all-btn all-category d-flex align-items-center">
                        <a href="#" class="btn btn-primary">{{ __("lang.read_more") }}</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
