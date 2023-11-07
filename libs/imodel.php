<?php
interface IModel
{
    public function getById($id);
    public function save();
    public function update();
    public function delete($id);
    public function from($array);
}
