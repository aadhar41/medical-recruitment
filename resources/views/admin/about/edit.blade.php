@extends('layouts.app')

@section('content')

<form action="{{ route('admin.about.update', $listings->id) }}" method="POST" enctype="multipart/form-data">
    {{ method_field('PUT') }}
    @csrf
    <section class="content">

        <div class="card">
            <div class="card-header">
                <h3 class="card-title">About Us Page Content</h3>

                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                        <i class="fas fa-minus"></i>
                    </button>
                    <button type="button" class="btn btn-tool" data-card-widget="remove">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
            </div>

            <div class="card-body">
                <div class="row">
                    <div class="col-md-12">

                        <div class="form-group">
                            <label for="title" class="css-social-icon">TITLE</label>

                            <textarea name="title" id="title" rows="4" class="ckeditor form-control {{ $errors->has('title') ? 'is-invalid' : '' }}" placeholder="Hero Section">{{ old('title', $listings->title) }}</textarea>
                            @if($errors->has('title'))
                            <div class="invalid-feedback">
                                <strong>{{ $errors->first('title') }}</strong>
                            </div>
                            @endif
                        </div>

                        <div class="form-group">
                            <label for="description-text" class="css-social-icon">DESCRIPTION</label>
                            <textarea name="description" id="description-text" rows="10" class="ckeditor form-control {{ $errors->has('description') ? 'is-invalid' : '' }}" placeholder="Description">{{ old('description', $listings->description) }}</textarea>
                            @if($errors->has('description'))
                            <div class="invalid-feedback">
                                <strong>{{ $errors->first('description') }}</strong>
                            </div>
                            @endif
                        </div>

                        <div class="form-group">
                            <label for="right_h_1" class="css-social-icon">HEADING - 1</label>
                            <textarea name="right_h_1" id="right_h_1" rows="10" class="ckeditor form-control {{ $errors->has('right_h_1') ? 'is-invalid' : '' }}" placeholder="Right Heading 1">{{ old('right_h_1', $listings->right_h_1) }}</textarea>
                            @if($errors->has('right_h_1'))
                            <div class="invalid-feedback">
                                <strong>{{ $errors->first('right_h_1') }}</strong>
                            </div>
                            @endif
                        </div>

                        <div class="form-group">
                            <label for="right_p_1" class="css-social-icon">PARAGRAPH - 1</label>
                            <textarea name="right_p_1" id="right_p_1" rows="10" class="ckeditor form-control {{ $errors->has('right_p_1') ? 'is-invalid' : '' }}" placeholder="Right Paragraph 1">{{ old('right_p_1', $listings->right_p_1) }}</textarea>
                            @if($errors->has('right_p_1'))
                            <div class="invalid-feedback">
                                <strong>{{ $errors->first('right_p_1') }}</strong>
                            </div>
                            @endif
                        </div>


                        <div class="form-group">
                            <label for="right_h_2" class="css-social-icon">HEADING - 2</label>
                            <textarea name="right_h_2" id="right_h_2" rows="10" class="ckeditor form-control {{ $errors->has('right_h_2') ? 'is-invalid' : '' }}" placeholder="Right Heading 2">{{ old('right_h_2', $listings->right_h_2) }}</textarea>
                            @if($errors->has('right_h_2'))
                            <div class="invalid-feedback">
                                <strong>{{ $errors->first('right_h_2') }}</strong>
                            </div>
                            @endif
                        </div>

                        <div class="form-group">
                            <label for="right_p_2" class="css-social-icon">PARAGRAPH - 2</label>
                            <textarea name="right_p_2" id="right_p_2" rows="10" class="ckeditor form-control {{ $errors->has('right_p_2') ? 'is-invalid' : '' }}" placeholder="Right Paragraph 2">{{ old('right_p_2', $listings->right_p_2) }}</textarea>
                            @if($errors->has('right_p_2'))
                            <div class="invalid-feedback">
                                <strong>{{ $errors->first('right_p_2') }}</strong>
                            </div>
                            @endif
                        </div>

                        <div class="form-group">
                            <label for="right_h_3" class="css-social-icon">HEADING - 3</label>
                            <textarea name="right_h_3" id="right_h_3" rows="10" class="ckeditor form-control {{ $errors->has('right_h_3') ? 'is-invalid' : '' }}" placeholder="Right Heading 2">{{ old('right_h_3', $listings->right_h_3) }}</textarea>
                            @if($errors->has('right_h_3'))
                            <div class="invalid-feedback">
                                <strong>{{ $errors->first('right_h_3') }}</strong>
                            </div>
                            @endif
                        </div>

                        <div class="form-group">
                            <label for="right_p_3" class="css-social-icon">PARAGRAPH - 3</label>
                            <textarea name="right_p_3" id="right_p_3" rows="10" class="ckeditor form-control {{ $errors->has('right_p_3') ? 'is-invalid' : '' }}" placeholder="Right Paragraph 3">{{ old('right_p_3', $listings->right_p_3) }}</textarea>
                            @if($errors->has('right_p_3'))
                            <div class="invalid-feedback">
                                <strong>{{ $errors->first('right_p_3') }}</strong>
                            </div>
                            @endif
                        </div>

                        <div class="form-group">
                            <label for="right_h_4" class="css-social-icon">HEADING - 4</label>
                            <textarea name="right_h_4" id="right_h_4" rows="10" class="ckeditor form-control {{ $errors->has('right_h_4') ? 'is-invalid' : '' }}" placeholder="Right Heading 2">{{ old('right_h_4', $listings->right_h_4) }}</textarea>
                            @if($errors->has('right_h_4'))
                            <div class="invalid-feedback">
                                <strong>{{ $errors->first('right_h_4') }}</strong>
                            </div>
                            @endif
                        </div>

                        <div class="form-group">
                            <label for="right_p_4" class="css-social-icon">PARAGRAPH - 4</label>
                            <textarea name="right_p_4" id="right_p_4" rows="10" class="ckeditor form-control {{ $errors->has('right_p_4') ? 'is-invalid' : '' }}" placeholder="Right Paragraph 4">{{ old('right_p_4', $listings->right_p_4) }}</textarea>
                            @if($errors->has('right_p_4'))
                            <div class="invalid-feedback">
                                <strong>{{ $errors->first('right_p_4') }}</strong>
                            </div>
                            @endif
                        </div>

                        <div class="form-group">
                            <label for="about_image" class="css-social-icon">ABOUT IMAGE</label>
                            <input type="file" name="about_image" id="about_image" class="form-control" />
                            <br />
                            @if(isset($listings->aboutcontent_image))
                            <img src="{{url('/images/aboutus/'.$listings->aboutcontent_image)}}" class="img-fluid img-thumbnail {{ $errors->has('about_image') ? 'is-invalid' : '' }}" alt="Image" height="200" width="200" />
                            @endif
                            @if($errors->has('about_image'))
                            <div class="invalid-feedback">
                                <strong>{{ $errors->first('about_image') }}</strong>
                            </div>
                            @endif
                        </div>

                    </div>
                </div>

            </div>

            <div class="card-footer">
                <button type="submit" class="btn btn-primary"><i class="far fa-hand-point-up"></i>&nbsp;&nbsp;Update</button>
            </div>

        </div>

    </section>
</form>

@include('partials._ckeditor')
@endsection