<?php

namespace App\Repositories;

use App\Models\Assignment;

class AssignmentRepository
{
    public function create($uuid, $person_id, $grade_id, $group_id, $career_id, $modality_id, $campus_id, $period_id, $year, $status)
    {
        $new_assignment['uuid'] = $uuid;
        $new_assignment['person_id'] = $person_id;
        $new_assignment['grade_id'] = $grade_id;
        $new_assignment['group_id'] = $group_id;
        $new_assignment['career_id'] = $career_id;
        $new_assignment['modality_id'] = $modality_id;
        $new_assignment['campus_id'] = $campus_id;
        $new_assignment['period_id'] = $period_id;
        $new_assignment['year'] = $year;
        $new_assignment['status'] = $status;
        return Assignment::create($new_assignment);
    }

    public function update($uuid, $person_id, $grade_id, $group_id, $career_id, $modality_id, $campus_id, $period_id, $year, $status)
    {
        $assignment = $this->find($uuid);
        $assignment->person_id = $person_id;
        $assignment->grade_id = $grade_id;
        $assignment->group_id = $group_id;
        $assignment->career_id = $career_id;
        $assignment->modality_id = $modality_id;
        $assignment->campus_id = $campus_id;
        $assignment->period_id = $period_id;
        $assignment->year = $year;
        $assignment->status = $status;
        $assignment->save();
        return $assignment;
    }

    public function delete($uuid)
    {
        $assignment = $this->find($uuid);
        return $assignment->delete();
    }

    public function find($uuid)
    {
        return Assignment::where('uuid', '=', $uuid)->first();
    }

    public function search($search)
    {
        return Assignment::where('year', 'like', '%' . $search . '%')->get();
    }

    public function list()
    {
        return Assignment::with('person', 'grade', 'group', 'career', 'modality', 'campus', 'period')->get();
    }
}
