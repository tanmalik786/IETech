@switch($section_type_id)
    @case('1')
        <div class="form-group">
            <label for="">Content</label>
            <textarea name="content" id="" cols="30" required rows="10" class="form-control"></textarea>
        </div>
    @break
    @case('2')
        <div class="form-group">
            <label for="">Hero Image</label>
            <input type="file" accept="image/*" required name="featured_image" class="form-control">
        </div>
    @break
    @case('3')
    <div class="form-group">
        <label for="">Slider</label>
        <select name="slider_id" id="" required class="custom-select">
            <option value=""></option>
            @foreach($sliders as $slider)
                <option value="{{$slider->id}}">{{$slider->name}}</option>
            @endforeach
        </select>
    </div>
    @break
    @case('4')
    <div class="form-group">
        <label for="">Carousel</label>
        <select name="carousel_id" id="" required class="custom-select">
            <option value=""></option>
            @foreach($carousels as $carousel)
                <option value="{{$carousel->id}}">{{$carousel->name}}</option>
            @endforeach
        </select>
    </div>
    @break
    @case('5')
    <div class="form-group">
        <label for="">Upload PDF</label>
        <input type="file" accept="application/pdf" name="pdf_file" required class="form-control">
    </div>
    @break
@endswitch