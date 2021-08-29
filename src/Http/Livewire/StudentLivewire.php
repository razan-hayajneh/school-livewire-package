<?php

namespace System\School\Http\Livewire;

use Livewire\Component;
use App\Models\Student;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
class StudentLivewire extends Component
{

    public $students, $name, $email, $phone, $studentId,$confirming;
    public $isModalOpen = 0;
    public $isAlertOpen = 0;
    public $isUpdateOpen= 0;

    /**
     * return all students and show them in the view.
     * @author Malak Obeidat <maobeidat115@gmail.com>
     * @return view
     */
    public function render()
    {
        $this->students = Student::all();
        return view('livewire.student-livewire');
    }

    /**
     * open modal to create student.
     * @author Malak Obeidat <maobeidat115@gmail.com>
     */
    public function create()
    {
        $this->resetCreateForm();
        $this->openModalPopover();
    }

    /**
     * open modal.
     * @author Malak Obeidat <maobeidat115@gmail.com>
     */
    public function openModalPopover()
    {
        $this->isModalOpen = true;
    }

    /**
     * close modal.
     * @author Malak Obeidat <maobeidat115@gmail.com>
     */
    public function closeModalPopover()
    {
        $this->isModalOpen = false;
    }


     /**
     * reset column.
     * @author Malak Obeidat <maobeidat115@gmail.com>
    */
    private function resetCreateForm(){
        $this->name = '';
        $this->email = '';
        $this->phone = '';
    }


     /**
     * store or update student fields.
     * @author Malak Obeidat <maobeidat115@gmail.com>
     */
    public function store()
    {
        $this->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'phone' => 'required|string|max:255',
        ]);

        $user =User::create([
            'name' => $this->name,
            'email' => $this->email,
            'password' => Hash::make('12345678'),
        ]);

        $user->attachRole('student');
        Student::create(
        [
            'name' => $this->name,
            'phone' => $this->phone,
            'user_id'=>$user->id
        ]);

        session()->flash('message',  'Student created.');

        $this->closeModalPopover();
        $this->resetCreateForm();
    }

    public function update()
    {
        $this->validate([
        'name' => 'required|string|max:255',
        'phone' => 'required|string|max:255',
        ]);

        if($this->studentId)
        {
            $student=Student::find($this->studentId);
            $student->update([
                'name' => $this->name,
                'phone' => $this->phone,
            ]);

            $this->closeUpdatePopover();
            session()->flash('message', 'Student Updated Successfully.');
            $this->resetCreateForm();

        }
    }
    public function openUpdatePopover()
    {
        $this->isUpdateOpen = true;
    }


    public function closeUpdatePopover()
    {
        $this->isUpdateOpen = false;
    }

    /**
     *fills existing student fields.
     *@param $id to check if student id is found
     * @author Malak Obeidat <maobeidat115@gmail.com>
     */
    public function edit(int $id)
    {
        $student = Student::findOrFail($id);

        $this->studentId = $id;
        $this->name = $student->name;
        $this->phone = $student->phone;
        $this->email=$student->user->email;
      $this->openUpdatePopover();

    }

    /**
     *modal for confirmation message.
     * @author Malak Obeidat <maobeidat115@gmail.com>
     */
    public function openAlertPopover()
    {
        $this->isAlertOpen = true;
    }

    /**
     *close modal of confirmation message.
     * @author Malak Obeidat <maobeidat115@gmail.com>
     */
    public function closeAlertPopover()
    {
        $this->isAlertOpen = false;
    }
    /**
     *delete student depends on its id.
     *@param $id to check if student id is found
     * @author Malak Obeidat <maobeidat115@gmail.com>
     */
    public function delete()
    {

        $student = Student::find($this->studentId);
        User::find($student->user_id)->delete();
        session()->flash('message', 'Student deleted.');
        $this->closeAlertPopover();
        $this->resetCreateForm();
    }
    /**
     *open modal to show an alert message.
     * @author Malak Obeidat <maobeidat115@gmail.com>
     */
    public function confirm($id)
    {
        $this->studentId=$id;
        $this-> openAlertPopover();
    }

}
