<!-- Modal Edit Profile -->
<div class="modal fade" id="edit_profile" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">

        <div class="modal-content">

            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
    
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Update Profile Information</h4>
                    <a class="heading-elements-toggle"><i class="fa fa-ellipsis-v font-medium-3"></i></a>
                    <div class="heading-elements">
                        <ul class="list-inline mb-0">
                            <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                            <li><a data-action="reload"><i class="ft-rotate-cw"></i></a></li>
                            <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                        </ul>
                    </div>
                </div>
                <div class="card-content collpase show">
                    <div class="card-body">
                        <div class="card-text">
                            <p class="card-text">@lang('site.update_profile_hint')</p>
                        </div>

                        <form   class="form" method="POST" enctype="multipart/form-data" 
                                action="{{ route('dashboard.users.update', ['user' => $row->id]) }}"
                        >
                            @method('PUT')
                            {{ csrf_field() }}
                            <div class="form-body">
                                <h4 class="form-section"><i class="ft-user"></i> @lang('site.personal_information') </h4>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="projectinput1" class="sr-only"> @lang('site.first_name') </label>
                                            <input type="text" id="projectinput1" class="form-control" placeholder="@lang('site.first_name')" name="fname">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="projectinput2" class="sr-only"> @lang('site.last_name') </label>
                                            <input type="text" id="projectinput2" class="form-control" placeholder="@lang('site.last_name')" name="lname">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="projectinput3" class="sr-only"> @lang('site.email') </label>
                                            <input type="text" id="projectinput3" class="form-control" placeholder="@lang('site.email')" name="email">
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="projectinput4" class="sr-only"> @lang('site.contact_number') </label>
                                            <input type="text" id="projectinput4" class="form-control" placeholder="@lang('site.phone')" name="phone">
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <fieldset class="form-group col-md-12">
                                        <label for="basicInputFile"> @lang('site.upload_photo') </label>
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input" id="profile_image" name="image">
                                            <label class="custom-file-label" for="profile_image"> @lang('site.choose_file') </label>
                                        </div>
                                    </fieldset>
                                </div>

                                <h4 class="form-section"><i class="ft-lock"></i> @lang('site.change_password') </h4>

                                <div class="form-group">
                                    <label for="current_password" class="sr-only"> @lang('site.current_password') </label>
                                    <input type="password" id="current_password" class="form-control" placeholder="@lang('site.current_password')" name="current_password">
                                </div>

                                <div class="form-group">
                                    <label for="new_password" class="sr-only">@lang('site.new_password')</label>
                                    <input type="password" id="new_password" class="form-control" placeholder="@lang('site.new_password')" name="new_password">
                                </div>

                                <div class="form-group">
                                    <label for="new_password_confirmation" class="sr-only">@lang('site.new_password_confirmation')</label>
                                    <input type="password" id="new_password_confirmation" class="form-control" placeholder="@lang('site.new_password_confirmation')" name="new_password_confirmation">
                                </div>
                            </div>

                            <div class="form-actions">
                                <button type="button" class="btn btn-outline-warning mr-1" data-dismiss="modal">
                                    <i class="ft-x"></i> @lang('site.cancel')
                                </button>
                                <button type="submit" class="btn btn-outline-primary">
                                    <i class="ft-check"></i> @lang('site.save')
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div> 

        </div>

    </div>
</div>
<!-- ./End Modal Edit Profile -->

<!-- Modal Edit Info -->
<div class="modal fade" id="edit_info" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">

    <div class="modal-content">

      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <div class="modal-body">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Update Site Information</h4>
                <a class="heading-elements-toggle"><i class="fa fa-ellipsis-v font-medium-3"></i></a>
                <div class="heading-elements">
                    <ul class="list-inline mb-0">
                        <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                        <li><a data-action="reload"><i class="ft-rotate-cw"></i></a></li>
                        <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                        <li><a data-action="close"><i class="ft-x"></i></a></li>
                    </ul>
                </div>
            </div>
            <div class="card-content collpase show">
                <div class="card-body">
                    <div class="card-text">
                        <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
                    </div>

                    <form class="form">
                        <div class="form-body">
                            <h4 class="form-section"><i class="ft-user"></i> Personal Info</h4>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="projectinput1" class="sr-only">First Name</label>
                                        <input type="text" id="projectinput1" class="form-control" placeholder="First Name" name="fname">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="projectinput2" class="sr-only">Last Name</label>
                                        <input type="text" id="projectinput2" class="form-control" placeholder="Last Name" name="lname">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="projectinput3" class="sr-only">E-mail</label>
                                        <input type="text" id="projectinput3" class="form-control" placeholder="E-mail" name="email">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="projectinput4" class="sr-only">Contact Number</label>
                                        <input type="text" id="projectinput4" class="form-control" placeholder="Phone" name="phone">
                                    </div>
                                </div>
                            </div>

                            <h4 class="form-section"><i class="ft-check-circle"></i> Requirements</h4>

                            <div class="form-group">
                                <label for="companyName" class="sr-only">Company</label>
                                <input type="text" id="companyName" class="form-control" placeholder="Company Name" name="company">
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="projectinput5" class="sr-only">Interested in</label>
                                        <select id="projectinput5" name="interested" class="form-control">
                                            <option value="none" selected="" disabled="">Interested in</option>
                                            <option value="design">design</option>
                                            <option value="development">development</option>
                                            <option value="illustration">illustration</option>
                                            <option value="branding">branding</option>
                                            <option value="video">video</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="projectinput6" class="sr-only">Budget</label>
                                        <select id="projectinput6" name="budget" class="form-control">
                                            <option value="0" selected="" disabled="">Budget</option>
                                            <option value="less than 5000$">less than 5000$</option>
                                            <option value="5000$ - 10000$">5000$ - 10000$</option>
                                            <option value="10000$ - 20000$">10000$ - 20000$</option>
                                            <option value="more than 20000$">more than 20000$</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="projectinput8" class="sr-only">About Project</label>
                                <textarea id="projectinput8" rows="5" class="form-control" name="comment" placeholder="About Project"></textarea>
                            </div>
                        </div>

                        <div class="form-actions">
                            <button type="button" class="btn btn-outline-warning mr-1">
                                <i class="ft-x"></i> Cancel
                            </button>
                            <button type="submit" class="btn btn-outline-primary">
                                <i class="ft-check"></i> Save
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
      </div>

      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>

    </div>

  </div>
</div>
<!-- ./End Modal Edit Info -->