<?php
namespace Razan\School\Http\Livewire;
use Livewire\Component;
use App\Models\Section;
use App\Models\Teacher;
use App\Models\User;
use Livewire\WithFileUploads;
use App\Models\Task;
use Illuminate\Support\Facades\Auth;
class TeacherdashLivewire extends Component
{
    use WithFileUploads;
    public $courses , $sections ,$tasks, $teachers , $students , $firstMark=0 , $secondMark=0 , $finalMark=0 , $marks ;
    public $studentMode = false;
    public $courseMode  = true;
    public $fileMode    = false;
    public $isModalOpen = false;
    public $taskMode    =false;
    public $isAlertOpen =false;
    public $sectionId , $studentId , $teacherId , $studentName , $taskId;
    public $successMessageFirst , $successMessageSecond , $successMessageFinal;
    public $attachment , $title;

    /**
     * show section,courses for a specific teacher.
     * @author Abeer Otoom <abeer2otoom@gmail.com>
     * @return view
     */
    public function render()
    {
        if($this->sectionId) {
            $this->showTask($this->sectionId);
            $this->taskMode=true;
        }
        $email=Auth::user()->email;
        $user=User::all()->where('email',$email)->first();
        $this->teachers=Teacher::all()->where('user_id',$user->id)->first();
        $this->courses=$this->teachers->sections;
        return view('livewire.teacher-dashboard.teacherdash-livewire');
    }
     /**
     * show student for a specific teacher.
     * @author Abeer Otoom <abeer2otoom@gmail.com>
     * @param sectionId
     */
    public function showStudent($id)
    {   $this->taskMode    = false;
        $this->studentMode = true;
        $this->courseMode  = false;
        $this->sections=Section::find($id);
    }
    /**
     * back to course view and hide student view or task view.
     * @author Abeer Otoom <abeer2otoom@gmail.com>
     */
    public function back()
    {   $this->studentMode = false;
        $this->courseMode  = true;
        $this->sectionId   ="";
        $this->taskMode   = false;
    }
    /**
     *open update mark modal.
     * @author Abeer Otoom <abeer2otoom@gmail.com>
     */
    public function openModalPopover()
    {  $this->isModalOpen = true;}
    /**
     *close all modal.
     * @author Abeer Otoom <abeer2otoom@gmail.com>
     */
    public function closeModal()
    {   $this->isModalOpen = false;
        $this->isAlertOpen = false;
    }
    /**
     * open update mark modal , find mark for specific student.
     * @author Abeer Otoom <abeer2otoom@gmail.com>
     * @param sectionId , studentId
     */
    public function edit(int $stdId,int $sectId )
    {   $this->sectionId=$sectId;
        $this->studentId=$stdId;
        $this->openModalPopover();
        $this->sections=Section::find($this->sectionId);
        $this->firstMark =$this->sections->students->find($this->studentId)->pivot->first;
        $this->secondMark =$this->sections->students->find($this->studentId)->pivot->mid;
        $this->finalMark =$this->sections->students->find($this->studentId)->pivot->final;
    }
    /**
     *update first mark for specific student.
     * @author Abeer Otoom <abeer2otoom@gmail.com>
    */
    public function updateFirst()
    {   $this->sections=Section::find( $this->sectionId);
        $this->sections->students()->updateExistingPivot($this->studentId,['first'=>$this->firstMark],false);
        session()->flash('message1', 'First Mark Updated Successfully.');
    }
    /**
     *update second mark for specific student.
     * @author Abeer Otoom <abeer2otoom@gmail.com>
    */
    public function updateSecond()
    {   $this->sections=Section::find( $this->sectionId);
        $this->sections->students()->updateExistingPivot($this->studentId,['mid'=>$this->secondMark],false);
        session()->flash('message2', 'Second Mark Updated Successfully.');
    }
    /**
     *update final mark for specific student.
     * @author Abeer Otoom <abeer2otoom@gmail.com>
    */
    public function updateFinal()
    {   $this->sections=Section::find( $this->sectionId);
        $this->sections->students()->updateExistingPivot($this->studentId,['final'=> $this->finalMark],false);
        session()->flash('message3', ' Final Mark Updated Successfully.');
    }
    /**
     * show task information.
     * @author Abeer Otoom <abeer2otoom@gmail.com>
     * @param sectionId
     */
    public function showTask($id){
        $this->sectionId=$id;
        $this->sections=Section::find($id);
        $this->tasks=$this->sections->tasks;
        $this->courseMode  = false;
        $this->taskMode    = true;
    }
    /**
     *modal for confirmation message.
     * @author Abeer Otoom <abeer2otoom@gmail.com>
    */
    public function openAlertPopover(){
        $this->isAlertOpen = true;
    }
    /**
     *delete specific task .
     * @author Abeer Otoom <abeer2otoom@gmail.com>
     */
    public function delete(){
        Task::find($this->taskId)->delete();
        $this->closeModal();
    }
    /**
     *open modal for alert confirmation message.
     * @author Abeer Otoom <abeer2otoom@gmail.com>
     * @param  taskId
     */
    public function confirm($id){
        $this->taskId=$id;
        $this->openAlertPopover();
    }
     /**
     *show upload file form.
     * @author Abeer Otoom <abeer2otoom@gmail.com>
    */
    public function openFileMode() {
        $this->fileMode = true;
        $this->taskMode = true;
    }
    /**
     *upload task and their title for specific section.
     * @author Abeer Otoom <abeer2otoom@gmail.com>
    */
    public function submit()
    {  $this->taskMode=true;
        $validatedData = $this->validate(['attachment' =>'mimes:pdf,ppt',
            'title'    =>'required']);

        $validatedData['attachment'] = $this->attachment->store('task','public');

        Task::create([
            'attachment'=>$validatedData['attachment'],
            'title'     =>$this->title,
            'section_id'=> $this->sectionId
        ]);
        session()->flash('message1', 'File successfully Uploaded.');
        $this->resetCreateForm();
    }
    /**
     *reset title field.
     * @author Abeer Otoom <abeer2otoom@gmail.com>
    */
    private function resetCreateForm(){
        $this->title = '';
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
