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
             <a class="page-link" href="{{ $data->path() . "?page=" . $data->currentPage() - 1 }}" tabindex="-1"><i class="fas fa-angle-left"></i></a>
         </li>


         @for($i = 1; $i <= $data->onEachSide; $i++)
             <li class="page-item first-page {{ $data->currentPage() == $i ? "active" : "" }}">
                 <a class="page-link" href="{{ $data->path() . "?page=$i" }}">{{ $i }}</a>
             </li>
         @endfor
         <li class="page-item next {{ $data->currentPage() == $data->lastPage() ? "disabled" : "" }}">
             <a class="page-link" href="{{ $data->path() . "?page=" . $data->currentPage() + 1 }}"><i class="fas fa-angle-right"></i></a>
         </li>
         </ul>
     </div>
 </div>
 <!-- /pagination -->
