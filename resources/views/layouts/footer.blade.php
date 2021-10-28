
                    		<!-- begin::User Panel-->
                            <div id="kt_quick_user" class="offcanvas offcanvas-right p-10">
                                <!--begin::Content-->
                                <div class="offcanvas-content pr-5 mr-n5">
                                    <!--begin::Header-->
                                    <div class="d-flex align-items-center mt-5">
                                        <span class="symbol symbol-100 mr-5 symbol-light-success">
                                            <span class="symbol-label font-size-h5 font-weight-bold">{{strtoupper(substr(Auth::user()->name,0,1))}}</span>
                                        </span>
                                        <div class="d-flex flex-column">
                                            <a href="#" class="font-weight-bold font-size-h5 text-dark-75 text-hover-primary">
                                                {{Auth::user()->name}}
                                            </a>
                                            <div class="text-muted mt-1">

@if(Auth::user()->role == 1)
<span class="label label-lg label-rounded label-danger label-jabatan">Super Admin</span>
@elseif(Auth::user()->role == 2)
<span class="label label-lg label-rounded label-primary label-jabatan">Store Officer</span>
@elseif(Auth::user()->role == 3)
<span class="label label-lg label-rounded label-info label-jabatan">Warehouse Officer</span>
@elseif(Auth::user()->role == 4)
<span class="label label-lg label-rounded label-success label-jabatan">Store Manager</span>
@endif
                                            </div>
                                            <div class="navi mt-2">
                                                <a href="{{url('/logout')}}" class="btn btn-sm btn-light-primary font-weight-bolder py-2 px-5">Sign Out</a>
                                            </div>
                                        </div>
                                    </div>
                                    <!--end::Header-->

                                    <!--begin::Separator-->
                                    <div class="separator separator-dashed mt-8 mb-5"></div>
                                    <!--end::Separator-->

                                    <!--begin::Nav-->
                                    <div class="navi navi-spacer-x-0 p-0">
                                        <!--begin::Item-->
                                        <a href="custom/apps/user/profile-1/personal-information.html" class="navi-item">
                                            <div class="navi-link">
                                                <div class="symbol symbol-40 bg-light mr-3">
                                                    <div class="symbol-label">
                                                        <span class="svg-icon svg-icon-md svg-icon-success"><!--begin::Svg Icon | path:assets/media/svg/icons/General/Notification2.svg--><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                    <rect x="0" y="0" width="24" height="24"/>
                                    <path d="M13.2070325,4 C13.0721672,4.47683179 13,4.97998812 13,5.5 C13,8.53756612 15.4624339,11 18.5,11 C19.0200119,11 19.5231682,10.9278328 20,10.7929675 L20,17 C20,18.6568542 18.6568542,20 17,20 L7,20 C5.34314575,20 4,18.6568542 4,17 L4,7 C4,5.34314575 5.34314575,4 7,4 L13.2070325,4 Z" fill="#000000"/>
                                    <circle fill="#000000" opacity="0.3" cx="18.5" cy="5.5" r="2.5"/>
                                </g>
                            </svg><!--end::Svg Icon--></span>						</div>
                                                </div>
                                                <div class="navi-text">
                                                    <div class="font-weight-bold">
                                                        My Profile
                                                    </div>
                                                    <div class="text-muted">
                                                        Account settings and more
                                                        <span class="label label-light-danger label-inline font-weight-bold">update</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </a>
                                        <!--end:Item-->

                                        <!--begin::Item-->
                                        <a href="custom/apps/user/profile-3.html"  class="navi-item">
                                            <div class="navi-link">
                                                <div class="symbol symbol-40 bg-light mr-3">
                                                    <div class="symbol-label">
                                                        <span class="svg-icon svg-icon-md svg-icon-warning"><!--begin::Svg Icon | path:assets/media/svg/icons/Shopping/Chart-bar1.svg--><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                    <rect x="0" y="0" width="24" height="24"/>
                                    <rect fill="#000000" opacity="0.3" x="12" y="4" width="3" height="13" rx="1.5"/>
                                    <rect fill="#000000" opacity="0.3" x="7" y="9" width="3" height="8" rx="1.5"/>
                                    <path d="M5,19 L20,19 C20.5522847,19 21,19.4477153 21,20 C21,20.5522847 20.5522847,21 20,21 L4,21 C3.44771525,21 3,20.5522847 3,20 L3,4 C3,3.44771525 3.44771525,3 4,3 C4.55228475,3 5,3.44771525 5,4 L5,19 Z" fill="#000000" fill-rule="nonzero"/>
                                    <rect fill="#000000" opacity="0.3" x="17" y="11" width="3" height="6" rx="1.5"/>
                                </g>
                            </svg><!--end::Svg Icon--></span> 					   </div>
                                                   </div>
                                                <div class="navi-text">
                                                    <div class="font-weight-bold">
                                                        My Messages
                                                    </div>
                                                    <div class="text-muted">
                                                        Inbox and tasks
                                                    </div>
                                                </div>
                                            </div>
                                        </a>
                                        <!--end:Item-->

                                        <!--begin::Item-->
                                        <a href="custom/apps/user/profile-2.html"  class="navi-item">
                                            <div class="navi-link">
                                                <div class="symbol symbol-40 bg-light mr-3">
                                                    <div class="symbol-label">
                                                        <span class="svg-icon svg-icon-md svg-icon-danger"><!--begin::Svg Icon | path:assets/media/svg/icons/Files/Selected-file.svg--><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                    <polygon points="0 0 24 0 24 24 0 24"/>
                                    <path d="M4.85714286,1 L11.7364114,1 C12.0910962,1 12.4343066,1.12568431 12.7051108,1.35473959 L17.4686994,5.3839416 C17.8056532,5.66894833 18,6.08787823 18,6.52920201 L18,19.0833333 C18,20.8738751 17.9795521,21 16.1428571,21 L4.85714286,21 C3.02044787,21 3,20.8738751 3,19.0833333 L3,2.91666667 C3,1.12612489 3.02044787,1 4.85714286,1 Z M8,12 C7.44771525,12 7,12.4477153 7,13 C7,13.5522847 7.44771525,14 8,14 L15,14 C15.5522847,14 16,13.5522847 16,13 C16,12.4477153 15.5522847,12 15,12 L8,12 Z M8,16 C7.44771525,16 7,16.4477153 7,17 C7,17.5522847 7.44771525,18 8,18 L11,18 C11.5522847,18 12,17.5522847 12,17 C12,16.4477153 11.5522847,16 11,16 L8,16 Z" fill="#000000" fill-rule="nonzero" opacity="0.3"/>
                                    <path d="M6.85714286,3 L14.7364114,3 C15.0910962,3 15.4343066,3.12568431 15.7051108,3.35473959 L20.4686994,7.3839416 C20.8056532,7.66894833 21,8.08787823 21,8.52920201 L21,21.0833333 C21,22.8738751 20.9795521,23 19.1428571,23 L6.85714286,23 C5.02044787,23 5,22.8738751 5,21.0833333 L5,4.91666667 C5,3.12612489 5.02044787,3 6.85714286,3 Z M8,12 C7.44771525,12 7,12.4477153 7,13 C7,13.5522847 7.44771525,14 8,14 L15,14 C15.5522847,14 16,13.5522847 16,13 C16,12.4477153 15.5522847,12 15,12 L8,12 Z M8,16 C7.44771525,16 7,16.4477153 7,17 C7,17.5522847 7.44771525,18 8,18 L11,18 C11.5522847,18 12,17.5522847 12,17 C12,16.4477153 11.5522847,16 11,16 L8,16 Z" fill="#000000" fill-rule="nonzero"/>
                                </g>
                            </svg><!--end::Svg Icon--></span>						</div>
                                                   </div>
                                                <div class="navi-text">
                                                    <div class="font-weight-bold">
                                                        My Activities
                                                    </div>
                                                    <div class="text-muted">
                                                        Logs and notifications
                                                    </div>
                                                </div>
                                            </div>
                                        </a>
                                        <!--end:Item-->

                                        <!--begin::Item-->
                                        <a href="custom/apps/userprofile-1/overview.html" class="navi-item">
                                            <div class="navi-link">
                                                <div class="symbol symbol-40 bg-light mr-3">
                                                    <div class="symbol-label">
                                                        <span class="svg-icon svg-icon-md svg-icon-primary"><!--begin::Svg Icon | path:assets/media/svg/icons/Communication/Mail-opened.svg--><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                    <rect x="0" y="0" width="24" height="24"/>
                                    <path d="M6,2 L18,2 C18.5522847,2 19,2.44771525 19,3 L19,12 C19,12.5522847 18.5522847,13 18,13 L6,13 C5.44771525,13 5,12.5522847 5,12 L5,3 C5,2.44771525 5.44771525,2 6,2 Z M7.5,5 C7.22385763,5 7,5.22385763 7,5.5 C7,5.77614237 7.22385763,6 7.5,6 L13.5,6 C13.7761424,6 14,5.77614237 14,5.5 C14,5.22385763 13.7761424,5 13.5,5 L7.5,5 Z M7.5,7 C7.22385763,7 7,7.22385763 7,7.5 C7,7.77614237 7.22385763,8 7.5,8 L10.5,8 C10.7761424,8 11,7.77614237 11,7.5 C11,7.22385763 10.7761424,7 10.5,7 L7.5,7 Z" fill="#000000" opacity="0.3"/>
                                    <path d="M3.79274528,6.57253826 L12,12.5 L20.2072547,6.57253826 C20.4311176,6.4108595 20.7436609,6.46126971 20.9053396,6.68513259 C20.9668779,6.77033951 21,6.87277228 21,6.97787787 L21,17 C21,18.1045695 20.1045695,19 19,19 L5,19 C3.8954305,19 3,18.1045695 3,17 L3,6.97787787 C3,6.70173549 3.22385763,6.47787787 3.5,6.47787787 C3.60510559,6.47787787 3.70753836,6.51099993 3.79274528,6.57253826 Z" fill="#000000"/>
                                </g>
                            </svg><!--end::Svg Icon--></span>						</div>
                                                   </div>
                                                <div class="navi-text">
                                                    <div class="font-weight-bold">
                                                        My Tasks
                                                    </div>
                                                    <div class="text-muted">
                                                        latest tasks and projects
                                                    </div>
                                                </div>
                                            </div>
                                        </a>
                                        <!--end:Item-->
                                    </div>
                                    <!--end::Nav-->



                                </div>
                                <!--end::Content-->
                            </div>
                            <!-- end::User Panel-->


                                                        <!--begin::Scrolltop-->
                            <div id="kt_scrolltop" class="scrolltop">
                                <span class="svg-icon"><!--begin::Svg Icon | path:assets/media/svg/icons/Navigation/Up-2.svg--><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                    <polygon points="0 0 24 0 24 24 0 24"/>
                                    <rect fill="#000000" opacity="0.3" x="11" y="10" width="2" height="10" rx="1"/>
                                    <path d="M6.70710678,12.7071068 C6.31658249,13.0976311 5.68341751,13.0976311 5.29289322,12.7071068 C4.90236893,12.3165825 4.90236893,11.6834175 5.29289322,11.2928932 L11.2928932,5.29289322 C11.6714722,4.91431428 12.2810586,4.90106866 12.6757246,5.26284586 L18.6757246,10.7628459 C19.0828436,11.1360383 19.1103465,11.7686056 18.7371541,12.1757246 C18.3639617,12.5828436 17.7313944,12.6103465 17.3242754,12.2371541 L12.0300757,7.38413782 L6.70710678,12.7071068 Z" fill="#000000" fill-rule="nonzero"/>
                                </g>
                            </svg><!--end::Svg Icon--></span></div>
                            <!--end::Scrolltop-->
