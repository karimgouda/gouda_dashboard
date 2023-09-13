<?php

namespace App\Http\Repositories;

use App\Http\Interfaces\ContactsInterface;
use App\Models\Contact;
use App\Services\BaseEloquentService;
use App\Services\TranslatableService;

class ContactsRepository extends BaseEloquentService implements ContactsInterface
{

    protected $modelName = Contact::class;

    public function __construct()
    {
        $this->instance = $this->getNewInstance();
    }


    public function index($dataTable)
    {
        return $dataTable->render('backend.contacts.index');
    }


    public function show($id)
    {
        $row = $this->findById($id);
        return view('backend.contacts.show', compact('row'));
    }

    public function store($request)
    {
       $this->executeSave($request->validated());
        return redirect()->back()->with('success','Thank you, our team will contact you');
    }
    public function updateStatus($id,$status)
    {
        $this->instance = $this->findById($id);
        $this->executeSave(['status' => $status]);
        return redirect()->route('contacts.index')->with('success','status update successfully');
    }


    public function destroy($id)
    {
        $this->delete($id);
        return redirect()->route('contacts.index')->with('success','contact deleted successfully');
    }

    public function bulkDestroy($ids)
    {
        $this->destroyAll($ids);
        return redirect()->route('contacts.index')->with('success','contacts deleted successfully');
    }
}
