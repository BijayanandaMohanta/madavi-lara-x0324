@extends('main.layouts.main')
@section('content')
    <section class="accrodion-one dlyremind">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 d-lg-block d-none">
                    @include('main.layouts.dashboard-menu')
                </div>
                <div class="col-lg-9 quizblock">
                    <h4 class="pb-1">Quizzes</h4>
                    <div class="row">
                        <div class="col-lg-12 mb-2">
                            <div class="card mb-2">
                                <div class="card-body p-1">
                                    <ul class="nav nav-pills nav-justified" id="pills-tab" role="tablist">
                                        <li class="nav-item" role="presentation">
                                            <button class="nav-link active" id="pills-upcoming-tab"
                                                    data-bs-toggle="pill" data-bs-target="#pills-upcoming" type="button"
                                                    role="tab" aria-controls="pills-upcoming" aria-selected="true">
                                                Upcoming
                                            </button>
                                        </li>
                                        <li class="nav-item" role="presentation">
                                            <button class="nav-link" id="pills-ongoing-tab" data-bs-toggle="pill"
                                                    data-bs-target="#pills-ongoing" type="button" role="tab"
                                                    aria-controls="pills-ongoing" aria-selected="false">Ongoing
                                            </button>
                                        </li>
                                        <li class="nav-item" role="presentation">
                                            <button class="nav-link" id="pills-completed-tab" data-bs-toggle="pill"
                                                    data-bs-target="#pills-completed" type="button" role="tab"
                                                    aria-controls="pills-completed" aria-selected="false">Completed
                                            </button>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="tab-content" id="pills-tabContent">
                                <div class="tab-pane fade show active" id="pills-upcoming" role="tabpanel"
                                     aria-labelledby="pills-upcoming-tab">
                                    <div class="row">
                                        <div class="col-lg-12 mb-3">
                                            <a href="dashboard-quizzes-test-view.php">
                                                <div class="card">
                                                    <div class="card-body p-2 px-3">
                                                        <h5>Inter Market Analysis</h5>
                                                        <div class="d-flex">
                                                            <p><i class="fal fa-clock"></i> Duration - 02:30.00</p>
                                                            <p><i class="fal fa-question-circle"></i> Total Question -
                                                                55</p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </a>
                                        </div>
                                        <div class="col-lg-12 mb-3">
                                            <a href="dashboard-quizzes-test-view.php">
                                                <div class="card">
                                                    <div class="card-body p-2 px-3">
                                                        <h5>Crude Oil & Natural Gas Fundamental</h5>
                                                        <div class="d-flex">
                                                            <p><i class="fal fa-clock"></i> Duration - 02:30.00</p>
                                                            <p><i class="fal fa-question-circle"></i> Total Question -
                                                                55</p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </a>
                                        </div>
                                        <div class="col-lg-12 mb-3">
                                            <a href="dashboard-quizzes-test-view.php">
                                                <div class="card">
                                                    <div class="card-body p-2 px-3">
                                                        <h5>Base Metals & Forex Level</h5>
                                                        <div class="d-flex">
                                                            <p><i class="fal fa-clock"></i> Duration - 02:30.00</p>
                                                            <p><i class="fal fa-question-circle"></i> Total Question -
                                                                55</p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </a>
                                        </div>
                                        <div class="col-lg-12 mb-3">
                                            <a href="dashboard-quizzes-test-view.php">
                                                <div class="card">
                                                    <div class="card-body p-2 px-3">
                                                        <h5>Crude Oil & Natural Gas Fundamental</h5>
                                                        <div class="d-flex">
                                                            <p><i class="fal fa-clock"></i> Duration - 02:30.00</p>
                                                            <p><i class="fal fa-question-circle"></i> Total Question -
                                                                55</p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="pills-ongoing" role="tabpanel"
                                     aria-labelledby="pills-ongoing-tab">
                                    <div class="row">
                                        <div class="col-lg-12 mb-3">
                                            <a href="dashboard-quizzes-test-view.php">
                                                <div class="card">
                                                    <div class="card-body p-2 px-3">
                                                        <h5>Inter Market Analysis</h5>
                                                        <div class="d-flex">
                                                            <p><i class="fal fa-clock"></i> Duration - 02:30.00</p>
                                                            <p><i class="fal fa-question-circle"></i> Total Question -
                                                                55</p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </a>
                                        </div>
                                        <div class="col-lg-12 mb-3">
                                            <a href="dashboard-quizzes-test-view.php">
                                                <div class="card">
                                                    <div class="card-body p-2 px-3">
                                                        <h5>Crude Oil & Natural Gas Fundamental</h5>
                                                        <div class="d-flex">
                                                            <p><i class="fal fa-clock"></i> Duration - 02:30.00</p>
                                                            <p><i class="fal fa-question-circle"></i> Total Question -
                                                                55</p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </a>
                                        </div>
                                        <div class="col-lg-12 mb-3">
                                            <a href="dashboard-quizzes-test-view.php">
                                                <div class="card">
                                                    <div class="card-body p-2 px-3">
                                                        <h5>Base Metals & Forex Level</h5>
                                                        <div class="d-flex">
                                                            <p><i class="fal fa-clock"></i> Duration - 02:30.00</p>
                                                            <p><i class="fal fa-question-circle"></i> Total Question -
                                                                55</p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </a>
                                        </div>
                                        <div class="col-lg-12 mb-3">
                                            <a href="dashboard-quizzes-test-view.php">
                                                <div class="card">
                                                    <div class="card-body p-2 px-3">
                                                        <h5>Crude Oil & Natural Gas Fundamental</h5>
                                                        <div class="d-flex">
                                                            <p><i class="fal fa-clock"></i> Duration - 02:30.00</p>
                                                            <p><i class="fal fa-question-circle"></i> Total Question -
                                                                55</p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="pills-completed" role="tabpanel"
                                     aria-labelledby="pills-completed-tab">
                                    <div class="row">
                                        <?php for ($i = 1;
                                                   $i <= 3;
                                                   $i++) { ?>
                                        <div class="col-lg-12 mb-3">
                                            <a href="dashboard-quiz-completed-test.php">
                                                <div class="card">
                                                    <div class="card-body p-2 px-3">
                                                        <span class="pass-result">PASS</span>
                                                        <h5>Inter Market Analysis</h5>
                                                        <ul class="qzstats">
                                                            <li>Total Questions : <span>10</span></li>
                                                            <li>Correct : <span>8</span></li>
                                                            <li>Score : <span>80</span></li>
                                                        </ul>
                                                        <div class="d-flex">
                                                            <p><i class="fal fa-calendar-alt"></i> Aug 12, 2023</p>
                                                            <p><i class="fal fa-clock"></i> 05:00 PM To 08:00 PM</p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </a>
                                        </div>
                                        <?php } ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
