<?php

	namespace App\Http\Controllers;

	use App\Models\Content;
	use App\Models\Image;
	use App\Models\Page;
	use App\Models\Section;
	use App\Models\SectionType;
	use App\Models\Slider;
	use Illuminate\Http\Request;

	class PageSectionController extends Controller {

		public function store( Request $request, Page $page ) {

			$order = 0;

			if( count($page->sections) > 0 ) {
				$order = $page->sections()->max('order') + 1;
			}

			switch ( $request->input( 'section_type_id' ) ) {
				case '1':
					$newContent = Content::create( [
						'page_id' => $page->id,
						'content' => $request->input('content')
					] );
					$newContent->sections()->create( [
						'page_id' => $page->id,
						'order'   => $order,
						'section_type_id' => $request->input('section_type_id')
					] );
					break;
				case '2':

					if ( $request->has( 'featured_image' ) ) {
						$fileName = $request->file( 'featured_image' )
						                    ->hashName();
						$request->featured_image->storeAs( 'public/pages/featured-images/', $fileName );

						$newImage = Image::create( [
							'page_id' => $page->id,
							'name'    => $fileName,
							'type'    => 'featured_image',
						] );

						$newImage->sections()->create( [
							'page_id' => $page->id,
							'order'   => $order,
							'section_type_id' => $request->input('section_type_id')
						] );

					}
					break;
				case '3':
					$slider = Slider::find( $request->input( 'slider_id' ) );
					$slider->sections()->create( [
						'page_id' => $page->id,
						'order'   => $order,
						'section_type_id' => $request->input('section_type_id')
					] );
					break;
				case '4':
					$carousel = Slider::find( $request->input( 'carousel_id' ) );
					$carousel->sections()->create( [
						'page_id' => $page->id,
						'order'   => $order,
						'section_type_id' => $request->input('section_type_id')
					] );
					break;
				case '5':
					if ( $request->has( 'pdf_file' ) ) {
						$fileName = $request->file( 'pdf_file' )
						                    ->hashName();
						$request->pdf_file->storeAs( 'public/pages/pdf/', $fileName );

						$newImage = Image::create( [
							'page_id' => $page->id,
							'name'    => $fileName,
							'type'    => 'pdf_file',
						] );

						$newImage->sections()->create( [
							'page_id' => $page->id,
							'order'   => $order,
							'section_type_id' => $request->input('section_type_id')
						] );

					}
					break;
			}

			return redirect( route( 'pages.edit', [ 'page' => $page->slug ] ) )->with( 'message', $this->_message( 'success', 'Section Added successfully' ) );
		}

		public function destroy(Page $page, Section $section) {
			$section->delete();
			return redirect( route( 'pages.edit', [ 'page' => $page->slug ] ) )->with( 'message', $this->_message( 'success', 'Section deleted successfully' ) );
		}

		public function show(Page $page, Section $section) {
			return view('pages.partials.modals.showSection', compact('section'));
		}
	}
