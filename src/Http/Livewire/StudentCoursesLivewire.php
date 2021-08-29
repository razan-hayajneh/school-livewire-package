<?php

namespace Razan\School\Http\Livewire;

use Livewire\Component;
use App\Models\Course;
use App\Models\Section;
use App\Models\Student;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
class StudentCoursesLivewire extends Component
{
    public $sections,$student,$sectionId,$section,$marks,$firstMark,$midMark,$finalMark;
     public $isModalOpen = 0;
//     public $isAlertOpen = 0;
//     public $isUpdateOpen= 0;
//     public $isUpdateSectionOpen= 0;
//     public $isSectionCreateOpen = 0;
//    public $isSectionAlertOpen = 0;

    public function render()
    {
        $email=Auth::user()->email;

        $user=User::all()->where('email',$email)->first();

        $this->student=Student::all()->where('user_id', $user->id)->first();

        $this->sections =$this->student->sections;


        return view('livewire.student-courses-livewire');
    }

    public function showMarksModal($id)
    {
        $this->sectionId=$id;


        $this->section = Section::all()->where('id', $id)->first();
        // $this->mark =$this->student->sections->where('section_id',$id);


        $this->firstMark =$this->student->sections->find($id)->pivot->first;

        $this->midMark =$this->student->sections->find($id)->pivot->mid;
        $this->finalMark =$this->student->sections->find($id)->pivot->final;

        $this->isModalOpen=true;

    }

    public function closeModalPopover()
    {
        $this->isModalOpen=false;
    }
}
