@extends('website_layouts.mainlayout')
@section('title') loomy edu @endsection
@section('content')

    <!-- Home Banner -->
    @include("website_layouts.home_sections.hero")
    <!-- /Home Banner -->

    <!-- statistics -->
    @include("website_layouts.home_sections.statistics")
    <!-- /statistics -->

    <!-- Top Categories -->
    @include("website_layouts.home_sections.category")
    <!-- /Top Categories -->

    <!-- Feature Course -->
    @include("website_layouts.home_sections.featured")
    <!-- /Feature Course -->

    <!-- Master Skill -->
    @include("website_layouts.home_sections.master_skills")
    <!-- /Master Skill -->

    <!-- Trending Course -->
    @include("website_layouts.home_sections.trending")
    <!-- /Trending Course -->

    <!-- Leading Companies -->
    @include("website_layouts.home_sections.leading_companies")
    <!-- /Leading Companies -->

    <!-- Share Knowledge -->
    @include("website_layouts.home_sections.share_knowledge")
    <!-- /Share Knowledge -->

    <!-- Say testimonial Four -->
{{--    @include("website_layouts.home_sections.testimonials")--}}
    <!-- /Say testimonial Four -->

    <!-- Become An Instructor -->
    @include("website_layouts.home_sections.become_teacher")
    <!-- /Become An Instructor -->

    <!-- Latest Blog -->
    @include("website_layouts.home_sections.blogs")
    <!-- /Latest Blog -->
@endsection

@section('script')
    <script>
        function getCurriculaOfYear() {
           let year_id = $("#years").val();
           window.location = APP_URL + "/curricula/" + year_id;
        }

        function onChangeYears(element)
        {
            if($(element).val() != "-1")
                $("#buttonSelectYear").prop("disabled", false)
            else
                $("#buttonSelectYear").prop("disabled", true)
        }

        function selectYears() {
            // Get the selected stage ID
            let stage_id = $("#stages").val();

            // Disable all year options initially
            $("#years option").each(function() {
                let yearStage = $(this).data("stage");
                if (yearStage == stage_id) {
                    $(this).prop("disabled", false);
                } else {
                    $(this).prop("disabled", true);
                }
            });
        }

        $(document).ready(function () {
            selectYears();
        });

    </script>
@endsection
