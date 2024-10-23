<?php
namespace App\Repositories;
use App\Models\CourseDetail;
use App\Repositories\BaseRepository;

class CourseRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'courseName',
        'courseDescription',
        'coursePrice',
        'courseThumbnile',
        'courseViews',
        'publishCourse',
        'uploadDate',
        'deleteCourse'
    ];

    /**
     * Return searchable fields
     *
     * @return array
     */
    public function getFieldsSearchable()
    {
        return $this->fieldSearchable;
    }

    /**
     * Configure the Model
     **/
    public function model()
    {
        return CourseDetail::class;
    }

    public function getAllCategory()
    {
        return $this->model->getAllCateories();
    }

    public function getSortByCategory($id)
    {
        return $this->model->getSortByCategory($id);
    }

    public function getUserCourse($uid)
    {
        return $this->model->getUserCourse($uid);
    }

    public function getAllCourses()
    {
        return $this->model->getAllCourses();
    }
    
    public function getCourse($courseId)
    {
        return $this->model->getCourse($courseId);
    }

    public function getCourseContent($courseId)
    {
        return $this->model->getCourseContent($courseId);
    }

    public function getCourseContentDraft($courseId)
    {
        return $this->model->getCourseContentDraft($courseId);
    }

    public function setFavourite($courseId, $userId, $status)
    {
        return $this->model->setFavourite($courseId, $userId, $status);
    }
    public function getFavourite($courseId, $userId)
    {
        return $this->model->getFavourite($courseId, $userId);
    }
}
