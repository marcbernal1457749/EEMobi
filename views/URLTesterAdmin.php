<div class="container-fluid">
    <div class="row">
        <div class="col">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#" onclick="otherActionsBackend()"></span>Altres Accions</a></li>
                    <li class="breadcrumb-item active">Testeig Automàtic de URLs</li>
                </ol>
            </nav>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-4"></div>
        <div class="col-lg-4 text-center">
            <h2>URL Tester</h2>
        </div>
        <div class="col-lg-4"></div>
    </div>
    <hr/>

    <div>
        <ul class="nav nav-tabs">
            <li class="active"><a data-toggle="tab" href="#tab-uni">Universitats</a></li>
            <li><a data-toggle="tab" href="#tab-assigUAB">Assignatures UAB</a></li>
            <li><a data-toggle="tab" href="#tab-assigEXT">Assignatures Externes</a></li>
        </ul>
    </div>
    <div class="tab-content">
        <div id="tab-uni" class="tab-pane fade in active">
            <br>
            <p class="text-muted"><em>Fes click al botó per revisar totes les URLs de la Web</em></p>
            <button class="btn btn-success btn-lg" id="testUrls" onclick="testUrlsUniversitat()">Testeja les URLs</button>
            <button class="btn btn-dark btn-lg" id="viewUrls" onclick="viewUrlsUnis()">Visualitza resultats anteriors</button>
            <hr/>
            <div id="loader"></div><br>
            <div id="result">
            </div>
        </div>

        <div id="tab-assigUAB" class="tab-pane fade">
            <br>
            <p class="text-muted"><em>Fes click al botó per revisar totes les URLs de la Web</em></p>
            <button class="btn btn-success btn-lg" id="testUrls" onclick="testUrlsAssigUAB()">Testeja les URLs</button>
            <button class="btn btn-dark btn-lg" id="viewUrls" onclick="viewUrlsAssigUAB()">Visualitza resultats anteriors</button>
            <hr/>
            <div id="loader1"></div><br>
            <div id="result1">
            </div>
        </div>
        <div id="tab-assigEXT" class="tab-pane fade">
            <br>
            <p class="text-muted"><em>Fes click al botó per revisar totes les URLs de la Web</em></p>
            <button class="btn btn-success btn-lg" id="testUrls" onclick="testUrlsAssigEXT()">Testeja les URLs</button>
            <button class="btn btn-dark btn-lg" id="viewUrls" onclick="viewUrlsAssigEXT()">Visualitza resultats anteriors</button>
            <hr/>
            <div id="loader2"><br></div><br>
            <div id="result2">
            </div>
        </div>
    </div>
</div>