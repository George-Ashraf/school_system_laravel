<?php

namespace App\Http\Livewire;

use App\Models\blood_type;
use App\Models\my_parent;
use App\Models\nationality;
use App\Models\parent_attach;
use App\Models\religion;
use Livewire\Component;
use Illuminate\Support\Facades\hash;
use Livewire\WithFileUploads;


class AddParent extends Component
{
    //  26:42 video 16

    use WithFileUploads;
    public $catchError, $updateMode = false, $photos;
    // 6:20 video 17
    public $show_table = true;

    public $successMessage = "";
    public $currentStep = 1,
        // Father_INPUTS
        $Email, $Password,
        $Name_Father, $Name_Father_en,
        $National_ID_Father, $Passport_ID_Father,
        $Phone_Father, $Job_Father, $Job_Father_en,
        $Nationality_Father_id, $Blood_Type_Father_id,
        $Address_Father, $Religion_Father_id, $Parent_id,

        // Mother_INPUTS
        $Name_Mother, $Name_Mother_en,
        $National_ID_Mother, $Passport_ID_Mother,
        $Phone_Mother, $Job_Mother, $Job_Mother_en,
        $Nationality_Mother_id, $Blood_Type_Mother_id,
        $Address_Mother, $Religion_Mother_id;



    // 3:51 video 15
    public function updated($propertyName)
    {
        $this->validateOnly($propertyName, [
            'Email' => 'required|email',
            'National_ID_Father' => 'required|string|min:14|max:14|regex:/[0-9]{9}/',
            'Passport_ID_Father' => 'min:14|max:14',
            'Phone_Father' => 'regex:/^([0-9\s\-\+\(\)]*)$/|min:10',
            'National_ID_Mother' => 'required|string|min:10|max:10|regex:/[0-9]{9}/',
            'Passport_ID_Mother' => 'min:10|max:10',
            'Phone_Mother' => 'regex:/^([0-9\s\-\+\(\)]*)$/|min:10'
        ]);
    }


    // 53:13 video 14
    public function render()
    {
        return view('livewire.add-parent', [
            'Nationalities' => nationality::all(),
            'Type_Bloods' => blood_type::all(),
            'Religions' => religion::all(),
            'my_parents' => my_parent::all()
        ]);
    }
    // 17:15 video 17
    public function showformadd()
    {
        $this->show_table = false;
    }
    // 1:01:39 video 14
    //firstStepSubmit
    public function firstStepSubmit()
    {
        // 11:24 video 15
        $this->validate([
            'Email' => 'required|unique:my_parents,email,' . $this->id,
            'Password' => 'required',
            'Name_Father' => 'required',
            'Name_Father_en' => 'required',
            'Job_Father' => 'required',
            'Job_Father_en' => 'required',
            'National_ID_Father' => 'required|unique:my_parents,father_national_id,' . $this->id,
            'Passport_ID_Father' => 'required|unique:my_parents,father_passport_id,' . $this->id,
            'Phone_Father' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:10',
            'Nationality_Father_id' => 'required',
            'Blood_Type_Father_id' => 'required',
            'Religion_Father_id' => 'required',
            'Address_Father' => 'required',
        ]);
        $this->currentStep = 2;
    }
    //secondStepSubmit
    public function secondStepSubmit()
    {
        $this->validate([
            'Name_Mother' => 'required',
            'Name_Mother_en' => 'required',
            'National_ID_Mother' => 'required|unique:my_parents,mother_national_id,' . $this->id,
            'Passport_ID_Mother' => 'required|unique:my_parents,mother_passport_id,' . $this->id,
            'Phone_Mother' => 'required',
            'Job_Mother' => 'required',
            'Job_Mother_en' => 'required',
            'Nationality_Mother_id' => 'required',
            'Blood_Type_Mother_id' => 'required',
            'Religion_Mother_id' => 'required',
            'Address_Mother' => 'required',
        ]);
        $this->currentStep = 3;
    }
    // 16:39 video 15
    public function submitForm()
    {

        try {
            $My_Parent = new my_parent();
            // Father_INPUTS
            $My_Parent->email = $this->Email;
            $My_Parent->password = hash::make($this->Password);
            $My_Parent->father_name = ['en' => $this->Name_Father_en, 'ar' => $this->Name_Father];
            $My_Parent->father_national_id = $this->National_ID_Father;
            $My_Parent->father_passport_id = $this->Passport_ID_Father;
            $My_Parent->father_phone = $this->Phone_Father;
            $My_Parent->father_job = ['en' => $this->Job_Father_en, 'ar' => $this->Job_Father];
            $My_Parent->father_passport_id = $this->Passport_ID_Father;
            $My_Parent->father_nationality_id = $this->Nationality_Father_id;
            $My_Parent->father_blood_type_id = $this->Blood_Type_Father_id;
            $My_Parent->father_religion_id = $this->Religion_Father_id;
            $My_Parent->father_address = $this->Address_Father;

            // Mother_INPUTS
            $My_Parent->mother_name = ['en' => $this->Name_Mother_en, 'ar' => $this->Name_Mother];
            $My_Parent->mother_national_id = $this->National_ID_Mother;
            $My_Parent->mother_passport_id = $this->Passport_ID_Mother;
            $My_Parent->mother_phone = $this->Phone_Mother;
            $My_Parent->mother_job = ['en' => $this->Job_Mother_en, 'ar' => $this->Job_Mother];
            $My_Parent->mother_passport_id = $this->Passport_ID_Mother;
            $My_Parent->mother_nationality_id = $this->Nationality_Mother_id;
            $My_Parent->mother_blood_type_id = $this->Blood_Type_Mother_id;
            $My_Parent->mother_religion_id = $this->Religion_Mother_id;
            $My_Parent->mother_address = $this->Address_Mother;
            $My_Parent->save();
            // 29:05 video 16
            if (!empty($this->photos)) {
                foreach ($this->photos as $photo) {
                    // 34:21 video 16
                    $photo->storeAs($this->National_ID_Father, $photo->getClientOriginalName(), $disk = 'parent_attachments');
                    parent_attach::create([
                        'file_name' => $photo->getClientOriginalName(),
                        // 40:03 video 16
                        'parent_id' => my_parent::latest()->first()->id,
                    ]);
                }
            }

            // 24:14 video 15
            $this->successMessage = trans('messages.success');
            // 27:18 video 15
            $this->clearForm();
            $this->currentStep = 1;
        } catch (\Exception $e) {
            // 36:19 video 15
            $this->catchError = $e->getMessage();
        };
    }
    // 24:14 video 17
    public function edit($id)
    {
        // 26:02 video 17
        $this->show_table = false;
        $this->updateMode = true;
        $My_Parent = My_Parent::where('id', $id)->first();
        $this->Parent_id = $id;
        $this->Email = $My_Parent->email;
        $this->Password = $My_Parent->password;
        $this->Name_Father = $My_Parent->getTranslation('father_name', 'ar');
        $this->Name_Father_en = $My_Parent->getTranslation('father_name', 'en');
        $this->Job_Father = $My_Parent->getTranslation('father_job', 'ar');;
        $this->Job_Father_en = $My_Parent->getTranslation('father_job', 'en');
        $this->National_ID_Father = $My_Parent->father_national_id;
        $this->Passport_ID_Father = $My_Parent->father_passport_id;
        $this->Phone_Father = $My_Parent->father_phone;
        $this->Nationality_Father_id = $My_Parent->father_nationality_id;
        $this->Blood_Type_Father_id = $My_Parent->father_blood_type_id;
        $this->Address_Father = $My_Parent->father_address;
        $this->Religion_Father_id = $My_Parent->father_religion_id;

        $this->Name_Mother = $My_Parent->getTranslation('mother_name', 'ar');
        $this->Name_Mother_en = $My_Parent->getTranslation('mother_name', 'en');
        $this->Job_Mother = $My_Parent->getTranslation('mother_job', 'ar');;
        $this->Job_Mother_en = $My_Parent->getTranslation('mother_job', 'en');
        $this->National_ID_Mother = $My_Parent->mother_national_id;
        $this->Passport_ID_Mother = $My_Parent->mother_passport_id;
        $this->Phone_Mother = $My_Parent->mother_phone;
        $this->Nationality_Mother_id = $My_Parent->mother_nationality_id;
        $this->Blood_Type_Mother_id = $My_Parent->mother_blood_type_id;
        $this->Address_Mother = $My_Parent->mother_address;
        $this->Religion_Mother_id = $My_Parent->mother_religion_id;
    }
    //firstStepSubmit
    //    32:44 video 17
    public function firstStepSubmit_edit()
    {
        $this->updateMode = true;
        $this->currentStep = 2;
    }
    //secondStepSubmit_edit
    //
    public function secondStepSubmit_edit()
    {
        $this->updateMode = true;
        $this->currentStep = 3;
    }
    // 40:10 video 17
    public function submitForm_edit()
    {

        if ($this->Parent_id) {
            $parent = My_Parent::find($this->Parent_id);
            $parent->update([
                'email' => $this->Email,
                'password' => $this->Password,
                'father_name' => $this->Name_Father,
                'father_job' => $this->Job_Father,
                'father_job' => $this->Job_Father_en,
                'father_name' => $this->Name_Father_en,
                'father_national_id' => $this->National_ID_Father,
                'father_passport_id' => $this->Passport_ID_Father,
                'father_phone' => $this->Phone_Father,
                'father_nationality_id' => $this->Nationality_Father_id,
                'father_blood_type_id' => $this->Blood_Type_Father_id,
                'father_address' => $this->Address_Father,
                'father_religion_id' => $this->Religion_Father_id,
                'mother_name' => $this->Name_Mother,
                'mother_job' => $this->Job_Mother,
                'mother_job' => $this->Job_Mother_en,
                'mother_name' => $this->Name_Mother_en,
                'mother_national_id' => $this->National_ID_Mother,
                'mother_passport_id' => $this->Passport_ID_Mother,
                'mother_phone' => $this->Phone_Mother,
                'mother_nationality_id' => $this->Nationality_Mother_id,
                'mother_blood_type_id' => $this->Blood_Type_Mother_id,
                'mother_address' => $this->Address_Mother,
                'mother_religion_id' => $this->Religion_Mother_id,
            ]);
        }

        return redirect()->to('/add_parent');
    }
    public function delete($id)
    {
        my_parent::find($id)->delete();
        return redirect()->to('/add_parent');
    }
    // clear form
    public function clearForm()
    {
        $this->Email = '';
        $this->Password = '';
        $this->Name_Father = '';
        $this->Job_Father = '';
        $this->Job_Father_en = '';
        $this->Name_Father_en = '';
        $this->National_ID_Father = '';
        $this->Passport_ID_Father = '';
        $this->Phone_Father = '';
        $this->Nationality_Father_id = '';
        $this->Blood_Type_Father_id = '';
        $this->Address_Father = '';
        $this->Religion_Father_id = '';

        $this->Name_Mother = '';
        $this->Job_Mother = '';
        $this->Job_Mother_en = '';
        $this->Name_Mother_en = '';
        $this->National_ID_Mother = '';
        $this->Passport_ID_Mother = '';
        $this->Phone_Mother = '';
        $this->Nationality_Mother_id = '';
        $this->Blood_Type_Mother_id = '';
        $this->Address_Mother = '';
        $this->Religion_Mother_id = '';
    }
    //back 1:08:08 video 14
    public function back($step)
    {
        $this->currentStep = $step;
    }
}
