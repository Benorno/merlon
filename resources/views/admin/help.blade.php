@extends('index')

@section('siteTitle', 'Merlon | Help')

@section('content')
    <header>
        @include('admin.header')
    </header>
    <main>
        <div class="container mt-5">
            <div class="row mb-3">
                <h1>Help</h1>
            </div>
            <div class="row">
                <div class="col">
                    <span class="fw-semibold">In case of technical difficulties:</span>
                        <br>
                        <a href="mailto:a.t.901200272367.u-60407100.73d3a9bf-57de-4fd2-a3c8-96bcaba91c68@tasks.clickup.com"
                            class="btn btn-outline-warning rounded-0 border-2 fw-semibold">Register a problem</a>
                </div>
                <div class="col">
                    <p><span class="fw-semibold">Usefull tools:</span>
                        <br>
                        <i class="bi bi-image"></i> <a href="https://www.remove.bg/" target="_black"
                            class="link-underline link-underline-opacity-0 link-info">Image Background Remover</a>
                        <br>
                        <i class="bi bi-aspect-ratio"></i> <a href="https://www.upscale.media/" target="_black"
                            class="link-underline link-underline-opacity-0 link-info">Image Quality Upscale</a>
                        <br>
                        <i class="bi bi-save2"></i> <a href="https://compressjpeg.com/" target="_black"
                            class="link-underline link-underline-opacity-0 link-info">Image Copressor (if size is over
                            2Mb)</a>
                    </p>
                </div>
            </div>
        </div>
    </main>
@endsection
