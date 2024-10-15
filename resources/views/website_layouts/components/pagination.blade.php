 <!-- pagination -->
 <div class="row">
     <div class="col-md-12">
         @if (!Route::is(['instructor-list']))
             <ul class="pagination lms-page">
         @endif
         @if (Route::is(['instructor-list']))
             <ul class="pagination lms-page lms-pagination">
         @endif
         @if (Route::is(['instructor-list']))
             <ul class="pagination lms-page mt-0">
         @endif

         <li class="page-item prev {{ $data->currentPage() == 1 ? "disabled" : "" }}">
             <a class="page-link" href="{{ $data->path() . "?page=" . $data->currentPage() - 1 }}" tabindex="-1"><i class="fas @if(app()->getLocale() == "ar") fa-angle-right @else fa-angle-left @endif"></i></a>
         </li>

         @for($i = 1; $i <= ceil($data->total() / $data->perPage()); $i++)
             <li class="page-item first-page {{ $data->currentPage() == $i ? "active" : "" }}">
                 <a class="page-link" href="{{ $data->path() . "?page=$i" }}">{{ $i }}</a>
             </li>
         @endfor
         <li class="page-item next {{ $data->currentPage() == $data->lastPage() ? "disabled" : "" }}">
             <a class="page-link" href="{{ $data->path() . "?page=" . $data->currentPage() + 1 }}"><i class="fas @if(app()->getLocale() == "ar") fa-angle-left @else fa-angle-right @endif"></i></a>
         </li>
         </ul>
     </div>
 </div>
 <!-- /pagination -->
