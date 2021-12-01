
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
<span class="label label-lg label-rounded label-success label-jabatan">Accountant</span>
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
