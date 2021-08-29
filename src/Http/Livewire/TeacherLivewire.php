<?php
namespace Razan\School\Http\Livewire;
use Livewire\Component;
use App\Models\Teacher;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
class TeacherLivewire extends Component
{
    public $teachers, $name, $email, $phone, $teacherId;
    public $isModalOpen = 0;
    public $isAlertOpen = 0;
    public $isUpdateOpen= 0;

    /**
     * return all teacher and show in view.
     * @author Abeer Otoom <abeer2otoom@gmail.com>
     * @return view
     */
    public function render()
    {
        $this->teachers = Teacher::all();
        return view('livewire.teacher-livewire');
    }
     /**
     * close all modal.
     * @author Abeer Otoom <abeer2otoom@gmail.com>
     */
    public function closeModal()
    {
        $this->isModalOpen = false;
        $this->isAlertOpen = false;
        $this->isUpdateOpen = false;
    }

    /**
     * open modal for add new teacher.
     * @author Abeer Otoom <abeer2otoom@gmail.com>
     */
    public function create()
    {
        $this->resetCreateForm();
        $this->openModalPopover();

    }

    /**
     * open create or update teacher modal.
     * @author Abeer Otoom <abeer2otoom@gmail.com>
     */
    public function openModalPopover()
    {
        $this->isModalOpen = true;
    }


    /**
     * reset feild column.
     * @author Abeer Otoom <abeer2otoom@gmail.com>
    */
    private function resetCreateForm(){
        $this->name = '';
        $this->email = '';
        $this->phone = '';
    }

    /**
     * validate input field and store teacher column.
     * @author Abeer Otoom <abeer2otoom@gmail.com>
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
        $user->attachRole('teacher');
        Teacher::create([
            'name' => $this->name,
            'phone' => $this->phone,
            'user_id'=>$user->id
        ]);

       session()->flash('message','Teacher created.');

        $this->closeModal();
        $this->resetCreateForm();
    }
    /**
     *modal for confirmation message.
     * @author Abeer Otoom <abeer2otoom@gmail.com>
    */
    public function openAlertPopover()
    {
        $this->isAlertOpen = true;
    }
    /**
     *find teacher to delete .
     * @author Abeer Otoom <abeer2otoom@gmail.com>
     */
    public function delete()
    {
        $teacher = Teacher::find($this->teacherId);
        User::find($teacher->user_id)->delete();
        session()->flash('message', 'Teacher deleted.');

        $this->closeModal();
        $this->resetCreateForm();
    }

    /**
     *open modal for alert confirmation message before delete.
     * @author Abeer Otoom <abeer2otoom@gmail.com>
     */
    public function confirm($id)
    {
        $this->teacherId=$id;
        $this-> openAlertPopover();
    }
    /**
     *open modal for update teacher information.
     * @author Abeer Otoom <abeer2otoom@gmail.com>
     */
    public function openUpdatePopover()
    {
        $this->isUpdateOpen = true;
    }
    /**
     *find teacher information for update.
     *@param teacherid
     * @author Abeer Otoom <abeer2otoom@gmail.com>
     */
    public function edit(int $id)
    {
        $this->openUpdatePopover();
        $teacher = Teacher::where('id',$id)->first();
        $email   = $teacher->user->email;
        $user=User::where('email',$email)->first();
        $this->teacherId = $id;
        $this->name = $teacher->name;
        $this->phone = $teacher->phone;
        $this->email=$email;
    }
    /**
     * validate input field and update teacher information.
     * @author Abeer Otoom <abeer2otoom@gmail.com>
    */
    public function update()
    {
        $this->validate([
        'name' => 'required|string|max:255',
        'phone' => 'required|string|max:255',
        ]);
        if($this->teacherId)
        {
            $teacher=Teacher::find($this->teacherId);
            $teacher->update([
                'name' => $this->name,
                'phone' => $this->phone,
            ]);
            $user=User::where('email',$teacher->user->email)->first();
            $user->update([
                'email'=>$this->email,
            ]);
            $this->closeModal();
            session()->flash('message', 'Teacher Updated Successfully.');
            $this->resetCreateForm();
        }
    }
}
