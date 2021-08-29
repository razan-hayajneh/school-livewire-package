<?php

namespace Razan\School\Http\Livewire;
use Livewire\Component;
use App\Models\Teacher;
use App\Models\Course;
use App\Models\Section;
use App\Models\Student;

class CourseLivewire extends Component
{
    public $courses,$section,$students,$student,$sections,$teachers, $name ,$courseId,$teacher,$sectionNumber,$sectionId;
    public $isModalOpen = 0;
    public $isAlertOpen = 0;
    public $isDeleteStudentAlertOpen=0;
    public $isUpdateOpen= 0;
    public $isUpdateSectionOpen= 0;
    public $isSectionCreateOpen = 0;
   public $isSectionAlertOpen = 0;
   public $sectionsMode =0;
   public $studentsMode =0;
   public $coursesMode =1;
   public $isAddStudentToSectionModal=0;

    /**
     * get all needed data.
     * @author Malak Obeidat <maobeidat115@gmail.com>
     * @return view
     */
    public function render()
    {
       if ($this->sectionId)
        {$this->section=Section::all()->where('id',$this->sectionId)->first();}
        $this->courses = Course::all();
        $this->sections = Section::all();
        $this->teachers = Teacher::all();
        $this->students = Student::all();
        return view('livewire.course-livewire');
    }

    /**
     * open create course modal.
     * @author Malak Obeidat <maobeidat115@gmail.com>
     */
    public function create()
    {
        $this->name = '';
        $this->openModalPopover();
    }
    /**
     * open create section modal.
     * @author Malak Obeidat <maobeidat115@gmail.com>
     * @param courseId
     */
    public function createSection()
    {
        $this->openSectionModalPopover();
    }

    /**
     * edit flag to open the create course modal.
     * @author Malak Obeidat <maobeidat115@gmail.com>
     */
    public function openModalPopover()
    {
        $this->isModalOpen = true;
    }
/**
     * get students blongs to a spasific section.
     * @author Malak Obeidat <maobeidat115@gmail.com>
     * @param sectionId
     */
  public function switchToAddStudentMode()
  {
      $this->isAddStudentToSectionModal=true;
  }
/**
     * open delete studengt confirmation message.
     * @author Malak Obeidat <maobeidat115@gmail.com>
     * @param studenId
     */
  public function confirmDeleteStudent($id)
  {
      $this->student=$id;
       $this->isDeleteStudentAlertOpen=true;
  }
  /**
     * add student to existing section.
     * @author Malak Obeidat <maobeidat115@gmail.com>
     */
  public function addStudentToSection()
  {
    $this->validate([
        'student' => 'required|unique:section_student,student_id',
    ]);

    $section=Section::find($this->sectionId);
    $section->students()->attach($this->student);
    $this->closeModalPopover();
    $this->SwitchToStudentsMode();
  }
  private function reloadSections()
  {
      $this->sections=Section::all();
  }
  /**
     * delete student from existing section.
     * @author Malak Obeidat <maobeidat115@gmail.com>
     */
  public function deleteStudentFromSection()
  {
    $section=Section::find($this->sectionId)->first();
    $section->students()->detach($this->student);
    $this->SwitchToStudentsMode();
    $this->sectionId=$section->id;
    $this->reloadSections();
    $this->closeModalPopover();
  }

  /**
     * edit flags to switch from sections view to students view.
     * @author Malak Obeidat <maobeidat115@gmail.com>
     * @param sectionId to keep it
     */
     public function switchMode($id)
     {
      $this->sectionId=$id;
      $this->sectionsMode=0;
      $this->studentsMode=1;
      $this->coursesMode=0;
      $this->section=Section::find($id);
     }
     /**
     * edit flags to switch from students view to sections view.
     * @author Malak Obeidat <maobeidat115@gmail.com>
     */
     public function switchToSectionsMode($id)
     {
         $this->reloadSections();
        $this->courseId=$id;
        $this->sectionsMode=1;
        $this->coursesMode=0;
        $this->studentsMode=0;

       }
       /**
     * edit flags to switch to courses view.
     * @author Malak Obeidat <maobeidat115@gmail.com>
     */
     public function switchToCoursesMode()
     {
        $this->sectionsMode=0;
        $this->coursesMode=1;
        $this->studentsMode=0;
       }
       /**
     * edit flags to switch from sections view to students view.
     * @author Malak Obeidat <maobeidat115@gmail.com>
     */
       public function switchToStudentsMode()
       {
          $this->sectionsMode=0;
          $this->coursesMode=0;
          $this->studentsMode=1;
       }

    /**
     * edit flag to open the create section modal.
     * @author Malak Obeidat <maobeidat115@gmail.com>
     */
    public function openSectionModalPopover()
    {
        $this->sectionNumber = '';
        $this->teacherId = '';
        $this->isSectionCreateOpen = true;
    }

    /**
     * edit flags to close any opened modal.
     * @author Malak Obeidat <maobeidat115@gmail.com>
     */
    public function closeModalPopover()
    {
        $this->isModalOpen = false;
        $this->isUpdateOpen = false;
        $this->isAlertOpen = false;
        $this->isSectionCreateOpen = false;
        $this->isUpdateSectionOpen = false;
        $this->isSectionAlertOpen = false;
        $this->isDeleteStudentAlertOpen=false;
        $this->isAddStudentToSectionModal=false;
    }
     /**
     * create new course.
     * @author Malak Obeidat <maobeidat115@gmail.com>
     */
    public function storeCourse()
    {

        $this->validate([
            'name' => 'required|string|max:255|unique:courses',
        ]);
       Course::create([   'name' => $this->name, ]);
       session()->flash('message','Course created.');
        $this->closeModalPopover();
        $this->name = '';
    }
     /**
     * create new section.
     * @author Malak Obeidat <maobeidat115@gmail.com>
     */
    public function storeSection()
    {
        $this->validate([
            'sectionNumber' => 'required',
            'teacher' => 'required',
        ]);
        $section=Section::all()->where('section_number',$this->sectionNumber)->where('course_id',$this->courseId);

         if(count($section)>0)
        {
            $this->validate([
                'sectionNumber' => 'unique:sections,section_number',

            ]);
        }
        Section::create([   'section_number' => $this->sectionNumber,
        'course_id' =>$this->courseId,
        'teacher_id' => $this->teacher,
    ]);

       session()->flash('message','Section created.');

        $this->closeModalPopover();

    }
     /**
     * update existing section.
     * @author Malak Obeidat <maobeidat115@gmail.com>
     */
    public function storeUpdatedSection()
    {
        $this->validate([
            'sectionNumber' => 'required',
            'teacher' => 'required',
        ]);
        if($this->sectionId)
        {
            $section=Section::find($this->sectionId);
            $section->update([
                'section_number' => $this->sectionNumber,
                'teacher_id' => $this->teacher,
            ]);
            session()->flash('message','Section updated.');
            $this->closeModalPopover();
        }
    }

 /**
     * create new section.
     * @author Malak Obeidat <maobeidat115@gmail.com>
     */
    public function storeCourseSection()
    {
        $this->validate([
            'name' => 'required',
        ]);
        $user =Course::create([   'name' => $this->name, ]);
       session()->flash('message','Course created.');
        $this->closeModalPopover();
        $this->name = '';
    }
    /**
     *open modal for confirmation message.
     * @author Malak Obeidat <maobeidat115@gmail.com>
     */
    public function openAlertPopover()
    {
        $this->isAlertOpen = true;
    }
     /**
     *open confirmation message modal when deleting section is selected.
     * @author Malak Obeidat <maobeidat115@gmail.com>
     */
    public function openSectionAlertPopover()
    {
        $this->isSectionAlertOpen = true;
    }

    /**
     *delete course depends on courseId.
     *@param courseId
     * @author Malak Obeidat <maobeidat115@gmail.com>
     */
    public function deleteCourse(int $id)
    {
        Course::find($id)->delete();
        session()->flash('message', 'Course deleted.');

         $this->closeModalPopover();
    }
    /**
     *delete section depends on sectionId.
     *@param sectionId
     * @author Malak Obeidat <maobeidat115@gmail.com>
     */
    public function deleteSection()
    {
        Section::find($this->sectionId)->delete();
        session()->flash('message', 'Section deleted.');
         $this->closeModalPopover();
    }

    /**
     *open confirmation modal .
     * @author Malak Obeidat <maobeidat115@gmail.com>
     */
    public function confirm()
    { $this->name = '';
        $this-> openAlertPopover();

    }
    /**
     *open confirmation modal .
     * @author Malak Obeidat <maobeidat115@gmail.com>
     */
    public function confirmDeleteSection($id)
    {
        $this->sectionId=$id;
        $this-> openSectionAlertPopover();
    }

    /**
     *edit flag to open course update modal .
     * @author Malak Obeidat <maobeidat115@gmail.com>
     */
    public function openUpdatePopover()
    {
        $this->isUpdateOpen = true;
    }
    /**
     *edit flag to open section update modal .
     * @author Malak Obeidat <maobeidat115@gmail.com>
     */
    public function openUpdateSectionPopover()
    {
        $this->isUpdateSectionOpen = true;
    }

    /**
     *fill fileds with old values in the course update modal .
     * @author Malak Obeidat <maobeidat115@gmail.com>
     * @param courseId
     */
    public function edit(int $id)
    {

        $this->courseId=$id;
        $course = Course::where('id',$id)->first();
        $this->courseId = $id;
        $this->name = $course->name;
        $this->openUpdatePopover();

    }
    /**
     *fill fileds with old values in the section update modal .
     * @author Malak Obeidat <maobeidat115@gmail.com>
     * @param sectionId
     */
    public function editSection(int $id)
    {

        $this->sectionId = $id;
        $this->openUpdateSectionPopover();
        $section = Section::where('id',$id)->first();
        $this->teacher = $section->teacher_id;
        $this->sectionNumber = $section->section_number;
        $this->courseId=$section->course_id;

    }
/**
     *update existing course .
     * @author Malak Obeidat <maobeidat115@gmail.com>
     */
    public function updateCourse()
    {
        $this->validate([  'name' => 'required|unique:courses'   ]);
        if($this->courseId)
        {
            $course=Course::find($this->courseId);
            $course->update([
                'name' => $this->name,
            ]);
            session()->flash('message','Course updated.');
            $this->closeModalPopover();
            $this->name = '';
    }
}}
