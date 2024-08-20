@if (Route::is(['student-tickets']))
    <!-- Modal -->
    <div class="modalStyle modal fade" id="addpaymentMethod" tabindex="-1" aria-labelledby="addpaymentMethod"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add New Payment Method</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close"><i
                            class="fa-regular fa-circle-xmark"></i></button>
                </div>
                <div class="modal-body">
                    <div class="addpaymethod-form">
                        <form action="#">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="wallet-method">
                                        <label class="radio-inline custom_radio me-4">
                                            <input type="radio" name="optradio" checked="">
                                            <span class="checkmark"></span> Credit or Debit card
                                        </label>
                                        <label class="radio-inline custom_radio">
                                            <input type="radio" name="optradio">
                                            <span class="checkmark"></span> PayPal
                                        </label>
                                    </div>
                                    <div class="input-block">
                                        <label class="form-control-label">Card Number</label>
                                        <input type="text" class="form-control" placeholder="XXXX XXXX XXXX XXXX">
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="input-block">
                                        <label class="form-label">Month</label>
                                        <select class="form-select" name="sellist1">
                                            <option>Month</option>
                                            <option>Brazil</option>
                                            <option>French</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="input-block">
                                        <label class="form-label">Year</label>
                                        <select class="form-select" name="sellist1">
                                            <option>Year</option>
                                            <option>India</option>
                                            <option>America</option>
                                            <option>London</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="input-block">
                                        <label class="form-control-label">CVV Code </label>
                                        <input type="text" class="form-control" placeholder="XXXX">
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="input-block mb-0">
                                        <label class="form-control-label">Name on Card</label>
                                        <input type="text" class="form-control" placeholder="Address">
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="modal-footer me-auto">
                    <button type="button" class="btn btn-modal-style btn-theme">Save changes</button>
                    <button type="button" class="btn btn-modal-style btn-cancel" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="add-tickets">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="page-wrapper-new p-0">
                    <div class="content">
                        <div class="modal-header border-0 custom-modal-header">
                            <div class="page-title">
                                <h4>Add New Ticket</h4>
                            </div>
                            <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                <i class="feather-x"></i>
                            </button>
                        </div>
                        <div class="modal-body custom-modal-body">
                            <form action="student-tickets">
                                <div class="tickets-add-list">
                                    <div class="settings-inner-blk add-course-info p-0">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="input-block">
                                                    <label class="form-label">Ticket Title</label>
                                                    <input type="text" class="form-control">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="input-block">
                                                    <label class="form-label">Category</label>
                                                    <select class="form-select select country-select" name="sellist1">
                                                        <option>Choose Category</option>
                                                        <option>Mailing Issue</option>
                                                        <option>Language Issue</option>
                                                        <option>Installation Error</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="input-block">
                                                    <label class="form-label">Priority</label>
                                                    <select class="form-select select country-select" name="sellist1">
                                                        <option>Choose Priority</option>
                                                        <option>High</option>
                                                        <option>Medium</option>
                                                        <option>Low</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="input-block">
                                                    <label class="form-label">Description</label>
                                                    <div id="editor"></div>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="input-block ">
                                                    <label class="form-label">Attachment</label>
                                                    <div class="file-drop">
                                                        <div action="#" class="dropzone">
                                                            <p>Drag & Drop files </p>
                                                        </div>
                                                    </div>
                                                    <div class="accept-drag-file">
                                                        <p>Accept File Type: doc,docx,jpg,jpeg,png,txt,pdf</p>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer-btn">
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                    <button type="button" class="btn btn-outline-primary"
                                        data-bs-dismiss="modal">Cancel</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endif

@if (Route::is(['instructor-tickets']))
	<!-- Modal -->
    <div class="modalStyle modal fade" id="addpaymentMethod" tabindex="-1" aria-labelledby="addpaymentMethod" aria-hidden="true">
        <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title" >Add New Payment Method</h5>
            <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close"><i class="fa-regular fa-circle-xmark"></i></button>
            </div>
            <div class="modal-body">
                <div class="addpaymethod-form">
                    <form action="#">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="wallet-method">
                                    <label class="radio-inline custom_radio me-4">
                                        <input type="radio" name="optradio" checked="">
                                        <span class="checkmark"></span> Credit or Debit card
                                    </label>
                                    <label class="radio-inline custom_radio">
                                        <input type="radio" name="optradio">
                                        <span class="checkmark"></span> PayPal
                                    </label>
                                </div>
                                <div class="input-block">
                                    <label class="form-control-label">Card Number</label>
                                    <input type="text" class="form-control" placeholder="XXXX XXXX XXXX XXXX">
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="input-block">
                                    <label  class="form-label">Month</label>
                                    <select class="form-select"  name="sellist1">
                                        <option>Month</option>
                                        <option>Brazil</option>
                                        <option>French</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="input-block">
                                    <label  class="form-label">Year</label>
                                    <select class="form-select"  name="sellist1">
                                        <option>Year</option>
                                        <option>India</option>
                                        <option>America</option>
                                        <option>London</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="input-block">
                                    <label class="form-control-label">CVV Code </label>
                                    <input type="text" class="form-control" placeholder="XXXX">
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="input-block mb-0">
                                    <label class="form-control-label">Name on Card</label>
                                    <input type="text" class="form-control" placeholder="Address">
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="modal-footer me-auto">
                <button type="button" class="btn btn-modal-style btn-theme">Save changes</button>
                <button type="button" class="btn btn-modal-style btn-cancel" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
        </div>
    </div>
    <div class="modal fade" id="add-tickets">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="page-wrapper-new p-0">
                    <div class="content">
                        <div class="modal-header border-0 custom-modal-header">
                            <div class="page-title">
                                <h4>Add New Ticket</h4>
                            </div>
                            <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                <i class="feather-x"></i>
                            </button>
                        </div>
                        <div class="modal-body custom-modal-body">
                            <form action="{{url('instructor-tickets')}}">
                                <div class="tickets-add-list">
                                    <div class="settings-inner-blk add-course-info p-0">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="input-block">
                                                    <label class="form-label">Ticket Title</label>
                                                    <input type="text" class="form-control" >
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="input-block">
                                                    <label  class="form-label">Category</label>
                                                    <select class="form-select select country-select"  name="sellist1">
                                                        <option>Choose Category</option>
                                                        <option>Mailing Issue</option>
                                                        <option>Language Issue</option>
                                                        <option>Installation Error</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="input-block">
                                                    <label  class="form-label">Priority</label>
                                                    <select class="form-select select country-select"  name="sellist1">
                                                        <option>Choose Priority</option>
                                                        <option>Mailing Issue</option>
                                                        <option>Language Issue</option>
                                                        <option>Installation Error</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="input-block">
                                                    <label class="form-label">Description</label>
                                                    <div id="editor"></div>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="input-block ">
                                                    <label class="form-label">Attachment</label>
                                                    <div class="file-drop">
                                                        <div action="#" class="dropzone">
                                                            <p >Drag & Drop files </p>
                                                        </div>
                                                    </div>
                                                    <div class="accept-drag-file">
                                                        <p>Accept File Type: doc,docx,jpg,jpeg,png,txt,pdf</p>
                                                    </div>
                                                </div>
                                            </div>
                                            
                                        </div>	
                                    </div>
                                </div>									
                                <div class="modal-footer-btn">
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                    <button type="button" class="btn btn-outline-primary" data-bs-dismiss="modal">Cancel</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endif
