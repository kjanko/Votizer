<?php

class Settings_model extends CI_Model
{
    public function categoryExists($category)
    {
        $query = $this->db->get_where('top_categories', array('category' => $category));

        if($query->num_rows() > 0)
            return true;
        else
            return false;
    }


    public function advertExists($url, $href, $location)
    {
        $query = $this->db->get_where('top_advertisements', array('url' => $url,'href' => $href, 'location' => $location));

        if($query->num_rows() > 0)
            return true;
        else
            return false;
    }

    public function insertCategory($category)
    {
        if(!self::categoryExists($category))
        {
            $data = array(
                'category' => $category
            );

            return $this->db->insert('top_categories', $data);
        }
        else
            return false;
    }

    public function insertAdvert($url, $href, $location)
    {
        if(!self::advertExists($url, $href, $location))
        {
            $data = array(
                'url' => $url,
                'href' => $href,
                'location' => $location
            );

            return $this->db->insert('top_advertisements', $data);
        }
        else
            return false;
    }

    public function removeCategory($id)
    {
        $data = array(
            'id' => $id
        );

        return $this->db->delete('top_categories', $data);
    }

    public function removeAdvert($id)
    {
        $data = array(
            'id' => $id
        );

        return $this->db->delete('top_advertisements', $data);
    }

    public function updateCategory($id, $category)
    {
        $data = array(
            'category' => $category
        );

        if($this->db->where('id', $id)->update('top_categories', $data))
            return true;
        else
            return false;
    }

    public function updateAdvertUrl($id, $value)
    {
        $data = array(
            'url' => $value
        );

        if($this->db->where('id', $id)->update('top_advertisements', $data))
            return true;
        else
            return false;
    }

    public function updateAdvertHref($id, $value)
    {
        $data = array(
            'href' => $value
        );

        if($this->db->where('id', $id)->update('top_advertisements', $data))
            return true;
        else
            return false;
    }

    public function updateAdvertLocation($id, $value)
    {
        $data = array(
            'location' => $value
        );

        if($this->db->where('id', $id)->update('top_advertisements', $data))
            return true;
        else
            return false;
    }
}