<?php
$body_class = 'products-page';
include('header.php');
// Connect to the database
include 'admin/connection.php';
?>

<body data-sveltekit-preload-data="hover" data-new-gr-c-s-check-loaded="14.1209.0" data-gr-ext-installed=""
    style="overflow: visible">
    <div style="display: contents">
        <div class="main-page-wrapper">
            <section class="job-listing-three pt-110 lg-pt-80 pb-160 xl-pb-150 lg-pb-80">
                <div class="container">
                    <div class="row">
                        <div class="col-xl-3 col-lg-4">
                            <button type="button"
                                class="filter-btn w-100 pt-2 pb-2 h-auto fw-500 tran3s d-lg-none mb-40"
                                data-bs-toggle="offcanvas" data-bs-target="#filteroffcanvas">
                                <i class="bi bi-funnel"></i> Filter
                            </button>
                            <div class="filter-area-tab offcanvas offcanvas-start" id="filteroffcanvas">
                                <button type="button" class="btn-close text-reset d-lg-none" data-bs-dismiss="offcanvas"
                                    aria-label="Close"></button>
                                <div class="main-title fw-500 text-dark">Filter By</div>
                                <div class="light-bg border-20 ps-4 pe-4 pt-25 pb-30 mt-20">
                                    <div class="filter-block bottom-line pb-25">
                                        <a class="filter-title fw-500 text-dark" data-bs-toggle="collapse"
                                            href="#collapseLocation" role="button" aria-expanded="false">Location</a>
                                        <div class="collapse show" id="collapseLocation">
                                            <div class="main-body">
                                                <select class="nice-select bg-white" style="display: none">
                                                    <option value="0">Washington DC</option>
                                                    <option value="1">California, CA</option>
                                                    <option value="2">New York</option>
                                                    <option value="3">Miami</option>
                                                </select>
                                                <div class="nice-select bg-white" tabindex="0">
                                                    <span class="current">Washington DC</span>
                                                    <ul class="list">
                                                        <li data-value="0" class="option selected">
                                                            Washington DC
                                                        </li>
                                                        <li data-value="1" class="option">
                                                            California, CA
                                                        </li>
                                                        <li data-value="2" class="option">New York</li>
                                                        <li data-value="3" class="option">Miami</li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="filter-block bottom-line pb-25 mt-25">
                                        <a class="filter-title fw-500 text-dark" data-bs-toggle="collapse"
                                            href="#collapseJobType" role="button" aria-expanded="false">Job Type</a>
                                        <div class="collapse show" id="collapseJobType">
                                            <div class="main-body">
                                                <ul class="style-none filter-input">
                                                    <li>
                                                        <input type="checkbox" name="JobType" value="01" />
                                                        <label for="">Fixed-Price <span>7</span></label>
                                                    </li>
                                                    <li>
                                                        <input type="checkbox" name="JobType" value="02" />
                                                        <label for="">Fulltime <span>3</span></label>
                                                    </li>
                                                    <li>
                                                        <input type="checkbox" name="JobType" value="03" />
                                                        <label for="">Part-time (20hr/week) <span>0</span></label>
                                                    </li>
                                                    <li>
                                                        <input type="checkbox" name="JobType" value="04" />
                                                        <label for="">Freelance <span>4</span></label>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="filter-block bottom-line pb-25 mt-25">
                                        <a class="filter-title fw-500 text-dark" data-bs-toggle="collapse"
                                            href="#collapseExp" role="button" aria-expanded="false">Experience</a>
                                        <div class="collapse show" id="collapseExp">
                                            <div class="main-body">
                                                <ul class="style-none filter-input">
                                                    <li>
                                                        <input type="checkbox" name="Experience" value="01" />
                                                        <label for="">Fresher <span>5</span></label>
                                                    </li>
                                                    <li>
                                                        <input type="checkbox" name="Experience" value="02" />
                                                        <label for="">Intermediate <span>3</span></label>
                                                    </li>
                                                    <li>
                                                        <input type="checkbox" name="Experience" value="03" />
                                                        <label for="">No-Experience <span>1</span></label>
                                                    </li>
                                                    <li>
                                                        <input type="checkbox" name="Experience" value="04" />
                                                        <label for="">Internship <span>12</span></label>
                                                    </li>
                                                    <li>
                                                        <input type="checkbox" name="Experience" value="05" />
                                                        <label for="">Expert <span>17</span></label>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="filter-block bottom-line pb-25 mt-25">
                                    </div>
                                    <div class="filter-block bottom-line pb-25 mt-25">
                                        <a class="filter-title fw-500 text-dark collapsed" data-bs-toggle="collapse"
                                            href="#collapseCategory" role="button" aria-expanded="false">Category</a>
                                        <div class="collapse" id="collapseCategory">
                                            <div class="main-body">
                                                <ul class="style-none filter-input">
                                                    <li>
                                                        <input type="checkbox" name="Experience" value="01" />
                                                        <label for="">Web Design <span>15</span></label>
                                                    </li>
                                                    <li>
                                                        <input type="checkbox" name="Experience" value="02" />
                                                        <label for="">Design &amp; Creative <span>8</span></label>
                                                    </li>
                                                    <li>
                                                        <input type="checkbox" name="Experience" value="03" />
                                                        <label for="">It &amp; Development <span>7</span></label>
                                                    </li>
                                                    <li>
                                                        <input type="checkbox" name="Experience" value="04" />
                                                        <label for="">Web &amp; Mobile Dev <span>5</span></label>
                                                    </li>
                                                    <li>
                                                        <input type="checkbox" name="Experience" value="05" />
                                                        <label for="">Writing <span>4</span></label>
                                                    </li>
                                                    <li class="hide">
                                                        <input type="checkbox" name="Experience" value="06" />
                                                        <label for="">Sales &amp; Marketing <span>25</span></label>
                                                    </li>
                                                    <li class="hide">
                                                        <input type="checkbox" name="Experience" value="07" />
                                                        <label for="">Music &amp; Audio <span>1</span></label>
                                                    </li>
                                                </ul>
                                                <div class="more-btn">
                                                    <i class="bi bi-plus"></i> Show More
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="filter-block bottom-line pb-25 mt-25">
                                        <a class="filter-title fw-500 text-dark collapsed" data-bs-toggle="collapse"
                                            href="https://jobi-svelte.vercel.app/job-list-v1#collapseTag" role="button"
                                            aria-expanded="false">Tags</a>
                                        <div class="collapse" id="collapseTag">
                                            <div class="main-body">
                                                <ul
                                                    class="style-none d-flex flex-wrap justify-space-between radio-filter mb-5">
                                                    <li>
                                                        <input type="checkbox" name="tags" value="01" />
                                                        <label for="">Web Design</label>
                                                    </li>
                                                    <li>
                                                        <input type="checkbox" name="tags" value="02" />
                                                        <label for="">Squarespace</label>
                                                    </li>
                                                    <li>
                                                        <input type="checkbox" name="tags" value="03" />
                                                        <label for="">Layout Design</label>
                                                    </li>
                                                    <li>
                                                        <input type="checkbox" name="tags" value="05" />
                                                        <label for="">Web Development</label>
                                                    </li>
                                                    <li>
                                                        <input type="checkbox" name="tags" value="04" />
                                                        <label for="">React</label>
                                                    </li>
                                                    <li>
                                                        <input type="checkbox" name="tags" value="06" />
                                                        <label for="">Full Stack</label>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                    <a href="https://jobi-svelte.vercel.app/job-list-v1#!"
                                        class="btn-ten fw-500 text-white w-100 text-center tran3s mt-30">Apply
                                        Filter</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-9 col-lg-8">
                            <div class="job-post-item-wrapper ms-xxl-5 ms-xl-3">
                                <div class="upper-filter d-flex justify-content-between align-items-center mb-20">
                                    <div class="total-job-found">
                                        All <span class="text-dark">7,096</span> jobs found
                                    </div>
                                    <div class="d-flex align-items-center">
                                        <button
                                            class="style-changer-btn text-center rounded-circle tran3s ms-2 list-btn"
                                            title="Active List">
                                            <i class="bi bi-list"></i>
                                        </button>
                                        <button
                                            class="style-changer-btn text-center rounded-circle tran3s ms-2 grid-btn active"
                                            title="Active Grid">
                                            <i class="bi bi-grid"></i>
                                        </button>
                                    </div>
                                </div>
                                <div class="accordion-box list-style show">
                                    <div class="job-list-one style-two position-relative border-style mb-20">
                                        <div class="row justify-content-between align-items-center">
                                            <div class="col-md-5">
                                                <div class="job-title d-flex align-items-center">
                                                    <a href="https://jobi-svelte.vercel.app/job-details-v1"
                                                        class="logo"><img
                                                            src="./Jobi - Responsive Job Board HTML Template_files/media_22.png"
                                                            data-src="/assets/images/logo/media_22.png" alt=""
                                                            class="lazy-img m-auto" /></a>
                                                    <div class="split-box1">
                                                        <a href="https://jobi-svelte.vercel.app/job-details-v1"
                                                            class="job-duration fw-500">Fulltime</a>
                                                        <a href="https://jobi-svelte.vercel.app/job-details-v1"
                                                            class="title fw-500 tran3s">Animator &amp; 3D Artist.</a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-4 col-sm-6">
                                                <div class="job-location">
                                                    <a href="https://jobi-svelte.vercel.app/job-details-v1">Spain,
                                                        Bercelona</a>
                                                </div>
                                                <div class="job-salary">
                                                    <span class="fw-500 text-dark">$30-$50</span> / hour
                                                    . Intermediate
                                                </div>
                                            </div>
                                            <div class="col-md-3 col-sm-6">
                                                <div
                                                    class="btn-group d-flex align-items-center justify-content-sm-end xs-mt-20">
                                                    <a href="https://jobi-svelte.vercel.app/job-details-v1"
                                                        class="save-btn text-center rounded-circle tran3s me-3"
                                                        title="Save Job"><i class="bi bi-bookmark-dash"></i></a>
                                                    <a href="https://jobi-svelte.vercel.app/job-details-v1"
                                                        class="apply-btn text-center tran3s">APPLY</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="job-list-one style-two position-relative border-style mb-20">
                                        <div class="row justify-content-between align-items-center">
                                            <div class="col-md-5">
                                                <div class="job-title d-flex align-items-center">
                                                    <a href="https://jobi-svelte.vercel.app/job-details-v1"
                                                        class="logo"><img
                                                            src="./Jobi - Responsive Job Board HTML Template_files/media_23.png"
                                                            data-src="/assets/images/logo/media_23.png" alt=""
                                                            class="lazy-img m-auto" /></a>
                                                    <div class="split-box1">
                                                        <a href="https://jobi-svelte.vercel.app/job-details-v1"
                                                            class="job-duration fw-500">Fulltime</a>
                                                        <a href="https://jobi-svelte.vercel.app/job-details-v1"
                                                            class="title fw-500 tran3s">Marketing Specialist.</a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-4 col-sm-6">
                                                <div class="job-location">
                                                    <a href="https://jobi-svelte.vercel.app/job-details-v1">US, New
                                                        York</a>
                                                </div>
                                                <div class="job-salary">
                                                    <span class="fw-500 text-dark">$22k-$30k</span> /
                                                    year . Expert
                                                </div>
                                            </div>
                                            <div class="col-md-3 col-sm-6">
                                                <div
                                                    class="btn-group d-flex align-items-center justify-content-sm-end xs-mt-20">
                                                    <a href="https://jobi-svelte.vercel.app/job-details-v1"
                                                        class="save-btn text-center rounded-circle tran3s me-3"
                                                        title="Save Job"><i class="bi bi-bookmark-dash"></i></a>
                                                    <a href="https://jobi-svelte.vercel.app/job-details-v1"
                                                        class="apply-btn text-center tran3s">APPLY</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="job-list-one style-two position-relative border-style mb-20">
                                        <div class="row justify-content-between align-items-center">
                                            <div class="col-md-5">
                                                <div class="job-title d-flex align-items-center">
                                                    <a href="https://jobi-svelte.vercel.app/job-details-v1"
                                                        class="logo"><img
                                                            src="./Jobi - Responsive Job Board HTML Template_files/media_24.png"
                                                            data-src="/assets/images/logo/media_24.png" alt=""
                                                            class="lazy-img m-auto" /></a>
                                                    <div class="split-box1">
                                                        <a href="https://jobi-svelte.vercel.app/job-details-v1"
                                                            class="job-duration fw-500 part-time">Part-time</a>
                                                        <a href="https://jobi-svelte.vercel.app/job-details-v1"
                                                            class="title fw-500 tran3s">Web Desginer.</a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-4 col-sm-6">
                                                <div class="job-location">
                                                    <a href="https://jobi-svelte.vercel.app/job-details-v1">Rome,
                                                        Italy</a>
                                                </div>
                                                <div class="job-salary">
                                                    <span class="fw-500 text-dark">$400-$550</span> /
                                                    week . Expert
                                                </div>
                                            </div>
                                            <div class="col-md-3 col-sm-6">
                                                <div
                                                    class="btn-group d-flex align-items-center justify-content-sm-end xs-mt-20">
                                                    <a href="https://jobi-svelte.vercel.app/job-details-v1"
                                                        class="save-btn text-center rounded-circle tran3s me-3"
                                                        title="Save Job"><i class="bi bi-bookmark-dash"></i></a>
                                                    <a href="https://jobi-svelte.vercel.app/job-details-v1"
                                                        class="apply-btn text-center tran3s">APPLY</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="job-list-one style-two position-relative border-style mb-20">
                                        <div class="row justify-content-between align-items-center">
                                            <div class="col-md-5">
                                                <div class="job-title d-flex align-items-center">
                                                    <a href="https://jobi-svelte.vercel.app/job-details-v1"
                                                        class="logo"><img
                                                            src="./Jobi - Responsive Job Board HTML Template_files/media_25.png"
                                                            data-src="/assets/images/logo/media_25.png" alt=""
                                                            class="lazy-img m-auto" /></a>
                                                    <div class="split-box1">
                                                        <a href="https://jobi-svelte.vercel.app/job-details-v1"
                                                            class="job-duration fw-500">Fulltime</a>
                                                        <a href="https://jobi-svelte.vercel.app/job-details-v1"
                                                            class="title fw-500 tran3s">Javascript Developer</a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-4 col-sm-6">
                                                <div class="job-location">
                                                    <a href="https://jobi-svelte.vercel.app/job-details-v1">Milan,
                                                        Italy</a>
                                                </div>
                                                <div class="job-salary">
                                                    <span class="fw-500 text-dark">$35k-$40k</span> /
                                                    year . Beginner
                                                </div>
                                            </div>
                                            <div class="col-md-3 col-sm-6">
                                                <div
                                                    class="btn-group d-flex align-items-center justify-content-sm-end xs-mt-20">
                                                    <a href="https://jobi-svelte.vercel.app/job-details-v1"
                                                        class="save-btn text-center rounded-circle tran3s me-3"
                                                        title="Save Job"><i class="bi bi-bookmark-dash"></i></a>
                                                    <a href="https://jobi-svelte.vercel.app/job-details-v1"
                                                        class="apply-btn text-center tran3s">APPLY</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="job-list-one style-two position-relative border-style mb-20">
                                        <div class="row justify-content-between align-items-center">
                                            <div class="col-md-5">
                                                <div class="job-title d-flex align-items-center">
                                                    <a href="https://jobi-svelte.vercel.app/job-details-v1"
                                                        class="logo"><img
                                                            src="./Jobi - Responsive Job Board HTML Template_files/media_26.png"
                                                            data-src="/assets/images/logo/media_26.png" alt=""
                                                            class="lazy-img m-auto" /></a>
                                                    <div class="split-box1">
                                                        <a href="https://jobi-svelte.vercel.app/job-details-v1"
                                                            class="job-duration fw-500">Fulltime</a>
                                                        <a href="https://jobi-svelte.vercel.app/job-details-v1"
                                                            class="title fw-500 tran3s">Inbound Call service.</a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-4 col-sm-6">
                                                <div class="job-location">
                                                    <a href="https://jobi-svelte.vercel.app/job-details-v1">UK,
                                                        London</a>
                                                </div>
                                                <div class="job-salary">
                                                    <span class="fw-500 text-dark">$30-$50</span> / hour
                                                    . Intermediate
                                                </div>
                                            </div>
                                            <div class="col-md-3 col-sm-6">
                                                <div
                                                    class="btn-group d-flex align-items-center justify-content-sm-end xs-mt-20">
                                                    <a href="https://jobi-svelte.vercel.app/job-details-v1"
                                                        class="save-btn text-center rounded-circle tran3s me-3"
                                                        title="Save Job"><i class="bi bi-bookmark-dash"></i></a>
                                                    <a href="https://jobi-svelte.vercel.app/job-details-v1"
                                                        class="apply-btn text-center tran3s">APPLY</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="job-list-one style-two position-relative border-style mb-20">
                                        <div class="row justify-content-between align-items-center">
                                            <div class="col-md-5">
                                                <div class="job-title d-flex align-items-center">
                                                    <a href="https://jobi-svelte.vercel.app/job-details-v1"
                                                        class="logo"><img
                                                            src="./Jobi - Responsive Job Board HTML Template_files/media_33.png"
                                                            data-src="/assets/images/logo/media_33.png" alt=""
                                                            class="lazy-img m-auto" /></a>
                                                    <div class="split-box1">
                                                        <a href="https://jobi-svelte.vercel.app/job-details-v1"
                                                            class="job-duration fw-500 part-time">Part-time</a>
                                                        <a href="https://jobi-svelte.vercel.app/job-details-v1"
                                                            class="title fw-500 tran3s">Document Typing.</a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-4 col-sm-6">
                                                <div class="job-location">
                                                    <a href="https://jobi-svelte.vercel.app/job-details-v1">UAE,
                                                        Dubai</a>
                                                </div>
                                                <div class="job-salary">
                                                    <span class="fw-500 text-dark">$3k-$4k</span> /
                                                    month . Expert
                                                </div>
                                            </div>
                                            <div class="col-md-3 col-sm-6">
                                                <div
                                                    class="btn-group d-flex align-items-center justify-content-sm-end xs-mt-20">
                                                    <a href="https://jobi-svelte.vercel.app/job-details-v1"
                                                        class="save-btn text-center rounded-circle tran3s me-3"
                                                        title="Save Job"><i class="bi bi-bookmark-dash"></i></a>
                                                    <a href="https://jobi-svelte.vercel.app/job-details-v1"
                                                        class="apply-btn text-center tran3s">APPLY</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="job-list-one style-two position-relative border-style mb-20">
                                        <div class="row justify-content-between align-items-center">
                                            <div class="col-md-5">
                                                <div class="job-title d-flex align-items-center">
                                                    <a href="https://jobi-svelte.vercel.app/job-details-v1"
                                                        class="logo"><img
                                                            src="./Jobi - Responsive Job Board HTML Template_files/lazy.svg"
                                                            data-src="/assets/images/logo/media_34.png" alt=""
                                                            class="lazy-img m-auto" /></a>
                                                    <div class="split-box1">
                                                        <a href="https://jobi-svelte.vercel.app/job-details-v1"
                                                            class="job-duration fw-500 part-time">Part-time</a>
                                                        <a href="https://jobi-svelte.vercel.app/job-details-v1"
                                                            class="title fw-500 tran3s">Hotel Manager</a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-4 col-sm-6">
                                                <div class="job-location">
                                                    <a href="https://jobi-svelte.vercel.app/job-details-v1">AUS,
                                                        Sydney</a>
                                                </div>
                                                <div class="job-salary">
                                                    <span class="fw-500 text-dark">$30-$50</span> / hour
                                                    . Intermediate
                                                </div>
                                            </div>
                                            <div class="col-md-3 col-sm-6">
                                                <div
                                                    class="btn-group d-flex align-items-center justify-content-sm-end xs-mt-20">
                                                    <a href="https://jobi-svelte.vercel.app/job-details-v1"
                                                        class="save-btn text-center rounded-circle tran3s me-3"
                                                        title="Save Job"><i class="bi bi-bookmark-dash"></i></a>
                                                    <a href="https://jobi-svelte.vercel.app/job-details-v1"
                                                        class="apply-btn text-center tran3s">APPLY</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="job-list-one style-two position-relative border-style mb-20">
                                        <div class="row justify-content-between align-items-center">
                                            <div class="col-md-5">
                                                <div class="job-title d-flex align-items-center">
                                                    <a href="https://jobi-svelte.vercel.app/job-details-v1"
                                                        class="logo"><img
                                                            src="./Jobi - Responsive Job Board HTML Template_files/lazy.svg"
                                                            data-src="/assets/images/logo/media_35.png" alt=""
                                                            class="lazy-img m-auto" /></a>
                                                    <div class="split-box1">
                                                        <a href="https://jobi-svelte.vercel.app/job-details-v1"
                                                            class="job-duration fw-500">Fulltime</a>
                                                        <a href="https://jobi-svelte.vercel.app/job-details-v1"
                                                            class="title fw-500 tran3s">Personal Assistant (HR)</a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-4 col-sm-6">
                                                <div class="job-location">
                                                    <a href="https://jobi-svelte.vercel.app/job-details-v1">USA,
                                                        Alaska</a>
                                                </div>
                                                <div class="job-salary">
                                                    <span class="fw-500 text-dark">$20-$25</span> / hour
                                                    . Intermediate
                                                </div>
                                            </div>
                                            <div class="col-md-3 col-sm-6">
                                                <div
                                                    class="btn-group d-flex align-items-center justify-content-sm-end xs-mt-20">
                                                    <a href="https://jobi-svelte.vercel.app/job-details-v1"
                                                        class="save-btn text-center rounded-circle tran3s me-3"
                                                        title="Save Job"><i class="bi bi-bookmark-dash"></i></a>
                                                    <a href="https://jobi-svelte.vercel.app/job-details-v1"
                                                        class="apply-btn text-center tran3s">APPLY</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="job-list-one style-two position-relative border-style mb-30">
                                        <div class="row justify-content-between align-items-center">
                                            <div class="col-md-5">
                                                <div class="job-title d-flex align-items-center">
                                                    <a href="https://jobi-svelte.vercel.app/job-details-v1"
                                                        class="logo"><img
                                                            src="./Jobi - Responsive Job Board HTML Template_files/lazy.svg"
                                                            data-src="/assets/images/logo/media_36.png" alt=""
                                                            class="lazy-img m-auto" /></a>
                                                    <div class="split-box1">
                                                        <a href="https://jobi-svelte.vercel.app/job-details-v1"
                                                            class="job-duration fw-500">Fulltime</a>
                                                        <a href="https://jobi-svelte.vercel.app/job-details-v1"
                                                            class="title fw-500 tran3s">Interactive Designer.</a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-4 col-sm-6">
                                                <div class="job-location">
                                                    <a href="https://jobi-svelte.vercel.app/job-details-v1">USA,
                                                        California</a>
                                                </div>
                                                <div class="job-salary">
                                                    <span class="fw-500 text-dark">$250-$300</span> /
                                                    week . Expert
                                                </div>
                                            </div>
                                            <div class="col-md-3 col-sm-6">
                                                <div
                                                    class="btn-group d-flex align-items-center justify-content-sm-end xs-mt-20">
                                                    <a href="https://jobi-svelte.vercel.app/job-details-v1"
                                                        class="save-btn text-center rounded-circle tran3s me-3"
                                                        title="Save Job"><i class="bi bi-bookmark-dash"></i></a>
                                                    <a href="https://jobi-svelte.vercel.app/job-details-v1"
                                                        class="apply-btn text-center tran3s">APPLY</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="accordion-box grid-style">
                                    <div class="row">
                                        <div class="col-sm-6 mb-30">
                                            <div class="job-list-two style-two position-relative">
                                                <a href="https://jobi-svelte.vercel.app/job-details-v2"
                                                    class="logo"><img
                                                        src="./Jobi - Responsive Job Board HTML Template_files/media_22.png"
                                                        data-src="/assets/images/logo/media_22.png" alt=""
                                                        class="lazy-img m-auto" /></a>
                                                <a href="https://jobi-svelte.vercel.app/job-details-v2"
                                                    class="save-btn text-center rounded-circle tran3s"
                                                    title="Save Job"><i class="bi bi-bookmark-dash"></i></a>
                                                <div>
                                                    <a href="https://jobi-svelte.vercel.app/job-details-v2"
                                                        class="job-duration fw-500">Fulltime</a>
                                                </div>
                                                <div>
                                                    <a href="https://jobi-svelte.vercel.app/job-details-v2"
                                                        class="title fw-500 tran3s">Lead designer &amp; expert in maya
                                                        3D</a>
                                                </div>
                                                <div class="job-salary">
                                                    <span class="fw-500 text-dark">$300-$450</span> /
                                                    Week
                                                </div>
                                                <div class="d-flex align-items-center justify-content-between mt-auto">
                                                    <div class="job-location">
                                                        <a href="https://jobi-svelte.vercel.app/job-details-v2">USA,
                                                            California</a>
                                                    </div>
                                                    <a href="https://jobi-svelte.vercel.app/job-details-v2"
                                                        class="apply-btn text-center tran3s">APPLY</a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-6 mb-30">
                                            <div class="job-list-two style-two position-relative">
                                                <a href="https://jobi-svelte.vercel.app/job-details-v2"
                                                    class="logo"><img
                                                        src="./Jobi - Responsive Job Board HTML Template_files/media_23.png"
                                                        data-src="/assets/images/logo/media_23.png" alt=""
                                                        class="lazy-img m-auto" /></a>
                                                <a href="https://jobi-svelte.vercel.app/job-details-v2"
                                                    class="save-btn text-center rounded-circle tran3s"
                                                    title="Save Job"><i class="bi bi-bookmark-dash"></i></a>
                                                <div>
                                                    <a href="https://jobi-svelte.vercel.app/job-details-v2"
                                                        class="job-duration fw-500 part-time">Part-time</a>
                                                </div>
                                                <div>
                                                    <a href="https://jobi-svelte.vercel.app/job-details-v2"
                                                        class="title fw-500 tran3s">Developer &amp; expert in c++ &amp;
                                                        java.</a>
                                                </div>
                                                <div class="job-salary">
                                                    <span class="fw-500 text-dark">$10-$15</span> / Hour
                                                </div>
                                                <div class="d-flex align-items-center justify-content-between mt-auto">
                                                    <div class="job-location">
                                                        <a href="https://jobi-svelte.vercel.app/job-details-v2">USA,
                                                            Alaska</a>
                                                    </div>
                                                    <a href="https://jobi-svelte.vercel.app/job-details-v2"
                                                        class="apply-btn text-center tran3s">APPLY</a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-6 mb-30">
                                            <div class="job-list-two style-two position-relative">
                                                <a href="https://jobi-svelte.vercel.app/job-details-v2"
                                                    class="logo"><img
                                                        src="./Jobi - Responsive Job Board HTML Template_files/media_24.png"
                                                        data-src="/assets/images/logo/media_24.png" alt=""
                                                        class="lazy-img m-auto" /></a>
                                                <a href="https://jobi-svelte.vercel.app/job-details-v2"
                                                    class="save-btn text-center rounded-circle tran3s"
                                                    title="Save Job"><i class="bi bi-bookmark-dash"></i></a>
                                                <div>
                                                    <a href="https://jobi-svelte.vercel.app/job-details-v2"
                                                        class="job-duration fw-500 part-time">Part-time</a>
                                                </div>
                                                <div>
                                                    <a href="https://jobi-svelte.vercel.app/job-details-v2"
                                                        class="title fw-500 tran3s">Marketing specialist in SEO &amp;
                                                        Affiliate.</a>
                                                </div>
                                                <div class="job-salary">
                                                    <span class="fw-500 text-dark">$40k</span> / Yearly
                                                </div>
                                                <div class="d-flex align-items-center justify-content-between mt-auto">
                                                    <div class="job-location">
                                                        <a href="https://jobi-svelte.vercel.app/job-details-v2">AUS,
                                                            Sydney</a>
                                                    </div>
                                                    <a href="https://jobi-svelte.vercel.app/job-details-v2"
                                                        class="apply-btn text-center tran3s">APPLY</a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-6 mb-30">
                                            <div class="job-list-two style-two position-relative">
                                                <a href="https://jobi-svelte.vercel.app/job-details-v2"
                                                    class="logo"><img
                                                        src="./Jobi - Responsive Job Board HTML Template_files/media_25.png"
                                                        data-src="/assets/images/logo/media_25.png" alt=""
                                                        class="lazy-img m-auto" /></a>
                                                <a href="https://jobi-svelte.vercel.app/job-details-v2"
                                                    class="save-btn text-center rounded-circle tran3s"
                                                    title="Save Job"><i class="bi bi-bookmark-dash"></i></a>
                                                <div>
                                                    <a href="https://jobi-svelte.vercel.app/job-details-v2"
                                                        class="job-duration fw-500">Fulltime</a>
                                                </div>
                                                <div>
                                                    <a href="https://jobi-svelte.vercel.app/job-details-v2"
                                                        class="title fw-500 tran3s">Lead &amp; Product &amp; Web
                                                        Designer.</a>
                                                </div>
                                                <div class="job-salary">
                                                    <span class="fw-500 text-dark">$2k-3k</span> / Month
                                                </div>
                                                <div class="d-flex align-items-center justify-content-between mt-auto">
                                                    <div class="job-location">
                                                        <a href="https://jobi-svelte.vercel.app/job-details-v2">UAE,
                                                            Dubai</a>
                                                    </div>
                                                    <a href="https://jobi-svelte.vercel.app/job-details-v2"
                                                        class="apply-btn text-center tran3s">APPLY</a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-6 mb-30">
                                            <div class="job-list-two style-two position-relative">
                                                <a href="https://jobi-svelte.vercel.app/job-details-v2"
                                                    class="logo"><img
                                                        src="./Jobi - Responsive Job Board HTML Template_files/lazy.svg"
                                                        data-src="/assets/images/logo/media_26.png" alt=""
                                                        class="lazy-img m-auto" /></a>
                                                <a href="https://jobi-svelte.vercel.app/job-details-v2"
                                                    class="save-btn text-center rounded-circle tran3s"
                                                    title="Save Job"><i class="bi bi-bookmark-dash"></i></a>
                                                <div>
                                                    <a href="https://jobi-svelte.vercel.app/job-details-v2"
                                                        class="job-duration fw-500">Fulltime</a>
                                                </div>
                                                <div>
                                                    <a href="https://jobi-svelte.vercel.app/job-details-v2"
                                                        class="title fw-500 tran3s">Hotel Manager with PHD in Hms.</a>
                                                </div>
                                                <div class="job-salary">
                                                    <span class="fw-500 text-dark">$40k-$60k</span> /
                                                    Year
                                                </div>
                                                <div class="d-flex align-items-center justify-content-between mt-auto">
                                                    <div class="job-location">
                                                        <a href="https://jobi-svelte.vercel.app/job-details-v2">UK,
                                                            London</a>
                                                    </div>
                                                    <a href="https://jobi-svelte.vercel.app/job-details-v2"
                                                        class="apply-btn text-center tran3s">APPLY</a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-6 mb-30">
                                            <div class="job-list-two style-two position-relative">
                                                <a href="https://jobi-svelte.vercel.app/job-details-v2"
                                                    class="logo"><img
                                                        src="./Jobi - Responsive Job Board HTML Template_files/lazy.svg"
                                                        data-src="/assets/images/logo/media_33.png" alt=""
                                                        class="lazy-img m-auto" /></a>
                                                <a href="https://jobi-svelte.vercel.app/job-details-v2"
                                                    class="save-btn text-center rounded-circle tran3s"
                                                    title="Save Job"><i class="bi bi-bookmark-dash"></i></a>
                                                <div>
                                                    <a href="https://jobi-svelte.vercel.app/job-details-v2"
                                                        class="job-duration fw-500 part-time">Part-time</a>
                                                </div>
                                                <div>
                                                    <a href="https://jobi-svelte.vercel.app/job-details-v2"
                                                        class="title fw-500 tran3s">Interactive Designer.</a>
                                                </div>
                                                <div class="job-salary">
                                                    <span class="fw-500 text-dark">$30-$35</span> / Hour
                                                </div>
                                                <div class="d-flex align-items-center justify-content-between mt-auto">
                                                    <div class="job-location">
                                                        <a href="https://jobi-svelte.vercel.app/job-details-v2">Milan,
                                                            Italy</a>
                                                    </div>
                                                    <a href="https://jobi-svelte.vercel.app/job-details-v2"
                                                        class="apply-btn text-center tran3s">APPLY</a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-6 mb-30">
                                            <div class="job-list-two style-two position-relative">
                                                <a href="https://jobi-svelte.vercel.app/job-details-v2"
                                                    class="logo"><img
                                                        src="./Jobi - Responsive Job Board HTML Template_files/lazy.svg"
                                                        data-src="/assets/images/logo/media_34.png" alt=""
                                                        class="lazy-img m-auto" /></a>
                                                <a href="https://jobi-svelte.vercel.app/job-details-v2"
                                                    class="save-btn text-center rounded-circle tran3s"
                                                    title="Save Job"><i class="bi bi-bookmark-dash"></i></a>
                                                <div>
                                                    <a href="https://jobi-svelte.vercel.app/job-details-v2"
                                                        class="job-duration fw-500 part-time">Part-time</a>
                                                </div>
                                                <div>
                                                    <a href="https://jobi-svelte.vercel.app/job-details-v2"
                                                        class="title fw-500 tran3s">Accountant Bookkeeper Financial
                                                        Reporting</a>
                                                </div>
                                                <div class="job-salary">
                                                    <span class="fw-500 text-dark">$300-$450</span> /
                                                    Week
                                                </div>
                                                <div class="d-flex align-items-center justify-content-between mt-auto">
                                                    <div class="job-location">
                                                        <a href="https://jobi-svelte.vercel.app/job-details-v2">US,
                                                            Alaska</a>
                                                    </div>
                                                    <a href="https://jobi-svelte.vercel.app/job-details-v2"
                                                        class="apply-btn text-center tran3s">APPLY</a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-6 mb-30">
                                            <div class="job-list-two style-two position-relative">
                                                <a href="https://jobi-svelte.vercel.app/job-details-v2"
                                                    class="logo"><img
                                                        src="./Jobi - Responsive Job Board HTML Template_files/lazy.svg"
                                                        data-src="/assets/images/logo/media_35.png" alt=""
                                                        class="lazy-img m-auto" /></a>
                                                <a href="https://jobi-svelte.vercel.app/job-details-v2"
                                                    class="save-btn text-center rounded-circle tran3s"
                                                    title="Save Job"><i class="bi bi-bookmark-dash"></i></a>
                                                <div>
                                                    <a href="https://jobi-svelte.vercel.app/job-details-v2"
                                                        class="job-duration fw-500">Fulltime</a>
                                                </div>
                                                <div>
                                                    <a href="https://jobi-svelte.vercel.app/job-details-v2"
                                                        class="title fw-500 tran3s">Personal assistants/ ARC readers
                                                        needed</a>
                                                </div>
                                                <div class="job-salary">
                                                    <span class="fw-500 text-dark">$2000</span> / Month
                                                </div>
                                                <div class="d-flex align-items-center justify-content-between mt-auto">
                                                    <div class="job-location">
                                                        <a href="https://jobi-svelte.vercel.app/job-details-v2">Rome,
                                                            Italy</a>
                                                    </div>
                                                    <a href="https://jobi-svelte.vercel.app/job-details-v2"
                                                        class="apply-btn text-center tran3s">APPLY</a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-6 mb-30">
                                            <div class="job-list-two style-two position-relative">
                                                <a href="https://jobi-svelte.vercel.app/job-details-v2"
                                                    class="logo"><img
                                                        src="./Jobi - Responsive Job Board HTML Template_files/lazy.svg"
                                                        data-src="/assets/images/logo/media_36.png" alt=""
                                                        class="lazy-img m-auto" /></a>
                                                <a href="https://jobi-svelte.vercel.app/job-details-v2"
                                                    class="save-btn text-center rounded-circle tran3s"
                                                    title="Save Job"><i class="bi bi-bookmark-dash"></i></a>
                                                <div>
                                                    <a href="https://jobi-svelte.vercel.app/job-details-v2"
                                                        class="job-duration fw-500">Fulltime</a>
                                                </div>
                                                <div>
                                                    <a href="https://jobi-svelte.vercel.app/job-details-v2"
                                                        class="title fw-500 tran3s">Hotel Manager with PHD in Hms.</a>
                                                </div>
                                                <div class="job-salary">
                                                    <span class="fw-500 text-dark">$40k-$60k</span> /
                                                    Year
                                                </div>
                                                <div class="d-flex align-items-center justify-content-between mt-auto">
                                                    <div class="job-location">
                                                        <a href="https://jobi-svelte.vercel.app/job-details-v2">US, New
                                                            York</a>
                                                    </div>
                                                    <a href="https://jobi-svelte.vercel.app/job-details-v2"
                                                        class="apply-btn text-center tran3s">APPLY</a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-6 mb-30">
                                            <div class="job-list-two style-two position-relative">
                                                <a href="https://jobi-svelte.vercel.app/job-details-v2"
                                                    class="logo"><img
                                                        src="./Jobi - Responsive Job Board HTML Template_files/lazy.svg"
                                                        data-src="/assets/images/logo/media_37.png" alt=""
                                                        class="lazy-img m-auto" /></a>
                                                <a href="https://jobi-svelte.vercel.app/job-details-v2"
                                                    class="save-btn text-center rounded-circle tran3s"
                                                    title="Save Job"><i class="bi bi-bookmark-dash"></i></a>
                                                <div>
                                                    <a href="https://jobi-svelte.vercel.app/job-details-v2"
                                                        class="job-duration fw-500 part-time">Part-time</a>
                                                </div>
                                                <div>
                                                    <a href="https://jobi-svelte.vercel.app/job-details-v2"
                                                        class="title fw-500 tran3s">Amazon Product Research</a>
                                                </div>
                                                <div class="job-salary">
                                                    <span class="fw-500 text-dark">$15-$20</span> / Hour
                                                </div>
                                                <div class="d-flex align-items-center justify-content-between mt-auto">
                                                    <div class="job-location">
                                                        <a href="https://jobi-svelte.vercel.app/job-details-v2">Germany,
                                                            Hamburg</a>
                                                    </div>
                                                    <a href="https://jobi-svelte.vercel.app/job-details-v2"
                                                        class="apply-btn text-center tran3s">APPLY</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="pt-30 lg-pt-20 d-sm-flex align-items-center justify-content-between">
                                    <p class="m0 order-sm-last text-center text-sm-start xs-pb-20">
                                        Showing <span class="text-dark fw-500">1 to 20</span> of
                                        <span class="text-dark fw-500">7,096</span>
                                    </p>
                                    <ul
                                        class="pagination-one d-flex align-items-center justify-content-center justify-content-sm-start style-none">
                                        <li class="active">
                                            <a href="https://jobi-svelte.vercel.app/job-list-v1#!">1</a>
                                        </li>
                                        <li>
                                            <a href="https://jobi-svelte.vercel.app/job-list-v1#!">2</a>
                                        </li>
                                        <li>
                                            <a href="https://jobi-svelte.vercel.app/job-list-v1#!">3</a>
                                        </li>
                                        <li>
                                            <a href="https://jobi-svelte.vercel.app/job-list-v1#!">4</a>
                                        </li>
                                        <li>....</li>
                                        <li class="ms-2">
                                            <a href="https://jobi-svelte.vercel.app/job-list-v1#!"
                                                class="d-flex align-items-center">Last
                                                <img src="./Jobi - Responsive Job Board HTML Template_files/icon_50.svg"
                                                    alt="" class="ms-2" /></a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <button class="scroll-top svelte-2f9mz0">
                <i class="bi bi-arrow-up-short"></i>
            </button>
            <div class="modal fade" id="loginModal" tabindex="-1" aria-hidden="true">
            </div>
        </div>
        <div id="svelte-announcer" aria-live="assertive" aria-atomic="true" style="
          position: absolute;
          left: 0px;
          top: 0px;
          clip: rect(0px, 0px, 0px, 0px);
          clip-path: inset(50%);
          overflow: hidden;
          white-space: nowrap;
          width: 1px;
          height: 1px;
        "></div>
    </div>
</body>

</html>