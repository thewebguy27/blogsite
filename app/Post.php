<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;
class Post extends Model
{
    use SoftDeletes;
    protected $dates=['published_at'];
    protected $fillable=[
        'title','description','content','img','published_at','categories_id','user_id'
    ];
    public function deleteImage(){
        Storage::delete($this->img);
        }
        public function categories(){
            return $this->belongsTo(Categories::class);
        }
        public function tags(){
            return $this->belongsToMany(Tag::class);
        }
        public function hastag($tagid){
            return in_array($tagid,$this->tags->pluck('id')->toArray());
        }
        public function user(){
            return $this->belongsTo(User::class);
        }
        public function scopeSearched($query){
            $search=request()->query('search');
            if(!$search){
                return $query->published();
            }
            else{
                return $query->published()->where('title','LIKE',"%{$search}%");
            }
        }
        public function scopePublished($query){
            return $query->where('published_at','<=',now());
        }
}