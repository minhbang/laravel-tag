<?php namespace Minhbang\Tag;

use Minhbang\Kit\Support\HasRouteAttribute;
use Minhbang\Layout\WidgetTypes\WidgetType;
use DB;
use Kit;

/**
 * Class TagsWidget
 *
 * @package Minhbang\Tag
 */
class TagsWidget extends WidgetType {
    use HasRouteAttribute;
    /**
     * @return static
     */
    public function getTagTypes() {
        return DB::table( 'taggables' )->distinct()->pluck( 'taggable_type' )->mapWithKeys( function ( $type ) {
            return [ $type => Kit::title( $type ) ];
        } );
    }

    /**
     * @return string
     */
    protected function formView() {
        return 'tag::widget.tags_form';
    }

    /**
     * @param $widget
     *
     * @return array|\Illuminate\Support\Collection
     */
    protected function getTags( $widget ) {
        return $widget->data['tag_type'] ?
            DB::table( 'taggables' )
              ->where( 'taggable_type', $widget->data['tag_type'] )
              ->leftJoin( 'tags', 'taggables.tag_id', '=', 'tags.id' )
              ->select( 'name', DB::raw( 'count(*) as count' ) )
              ->orderBy( 'count', 'desc' )
              ->groupBy( 'tag_id' )
              ->pluck( 'count', 'name' ) :
            [];
    }

    /**
     * @param \Minhbang\Layout\Widget $widget
     *
     * @return string
     */
    protected function content( $widget ) {
        $tags = $this->getTags( $widget )->all();

        return view( 'tag::widget.tags_output', compact( 'widget', 'tags' ) )->render();
    }

    protected function dataAttributes() {
        return [
            [ 'name' => 'tag_type', 'title' => __('Tag type' ), 'rule' => 'required|max:255', 'default' => null ],
            [ 'name' => 'route_show', 'title' => __('Tags page route' ), 'rule' => 'required|max:255', 'default' => '#' ],
            [ 'name' => 'tag_css', 'title' => __('Tag item CSS' ), 'rule' => 'max:255', 'default' => 'label label-primary' ],
            [ 'name' => 'show_count', 'title' => __('Show count' ), 'rule' => 'integer', 'default' => 0 ],
        ];
    }
}