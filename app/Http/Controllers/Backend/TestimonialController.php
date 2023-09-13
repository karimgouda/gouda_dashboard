<?php

namespace App\Http\Controllers\Backend;

use App\DataTables\TestimonialDataTable;
use App\Http\Controllers\Controller;
use App\Http\Interfaces\TestimonialInterface;
use App\Http\Requests\testimonialsRequest;
use Illuminate\Http\Request;

class TestimonialController extends Controller
{
    private $testimonialInterface;
    public function __construct(TestimonialInterface $testimonial)
    {
        $this->testimonialInterface = $testimonial;
    }

    public function index(TestimonialDataTable $dataTable)
    {
        return $this->testimonialInterface->index($dataTable);
    }

    public function create()
    {
        return $this->testimonialInterface->create();
    }

    public function store(testimonialsRequest $request)
    {
        return $this->testimonialInterface->store($request);
    }

    public function edit($id)
    {
        return $this->testimonialInterface->edit($id);
    }

    public function update(testimonialsRequest $request , $id)
    {
        return $this->testimonialInterface->update($request , $id);
    }

    public function destroy($id)
    {
        return $this->testimonialInterface->destroy($id);
    }

}
