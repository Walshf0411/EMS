<ul class="nav nav-pills" id="myTab" role="tablist">
    <li class="nav-item">
        <a class="nav-link active" id="electrical-requirements-tab-1" data-toggle="pill" href="#electrical-requirements-1" role="tab" aria-controls="electrical" aria-selected="true">Electrical Requirements 1</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" id="electrical-requirements-tab-2" data-toggle="pill" href="#electrical-requirements-2" role="tab" aria-controls="profile" aria-selected="false">Electrical Requirements 2</a>
    </li>
</ul>
<div class="tab-content" id="myTabContent">
    <div class="tab-pane fade show active" id="electrical-requirements-1" role="tabpanel" aria-labelledby="home-tab">
        <?php include("exhibitor_optional_form6.php");?>
    </div>
    <div class="tab-pane fade" id="electrical-requirements-2" role="tabpanel" aria-labelledby="profile-tab">
        <?php include("exhibitor_optional_form7.php");?>
    </div>
</div>