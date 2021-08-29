<?php

namespace Razan\School\Http\Livewire;
use Livewire\WithFileUploads;
use App\Models\Task;
use App\Models\Student;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class StudentTaskLivewire extends Component
{
    use WithFileUploads;

    public  $sections , $student , $task , $attachment;

    /**
     * return section,courses and task for a specific student.
     * @author Abeer Otoom <abeer2otoom@gmail.com>
     * @return view
    */
    public function render()
    {   $email=Auth::user()->email;
        $user=User::all()->where('email',$email)->first();
        $this->student=Student::all()->where('user_id',$user->id)->first();
        $this->sections=$this->student->sections;
        return view('livewire.student-dashboard.student-task-livewire');

    }
    /**
     * take taskId and return task attachment and download it.
     * @author Abeer Otoom <abeer2otoom@gmail.com>
     * @param taskId
     * @return download file
     */
    public function export(int $id)
    {
       $this->task=Task::all()->where('id',$id)->first();
       $this->attachment=$this->task->attachment;

      return response()->download(storage_path("app/public/{$this->attachment}"));

    }

}
