<?php defined('SYSPATH') OR die('No direct access allowed.');
    /**
     * A dynamic changelog for the website.
     *
     * @author      Kim Burgestrand <kim@burgestrand.se>
     * @license     http://www.gnu.org/licenses/lgpl-3.0.txt
     */
     class Controller_Changelog extends Controller_Template
     {
         public $template = 'template';
         public $repo     = NULL;
         
         public function action_index()
         {
             $this->template->title = 'Project activity';
             $this->template->content = View::factory('changelog/index')
                                      ->set('history', $this->history());
         }
         
         public function action_view($hash = NULL)
         {
             $commit = $this->repo->getObject(sha1_bin($hash));
             
             require Kohana::find_file('vendor', 'htmlpurifier/library/htmlpurifier.auto');
             require Kohana::find_file('vendor', 'markdown/markdown');
             
             $this->template->title   = html::chars($commit->summary);
             $this->template->content = View::factory('changelog/view')
                                     ->set('commit', $commit)
                                     ->set('htmlpurifier', new HTMLPurifier());
         }
         
         public function before()
         {
             parent::before();
             require Kohana::find_file('vendor', 'glip/lib/glip');
             $this->repo = new Git(APPPATH . '../.git/');
         }
         
         /**
          * Retrieves the history of this projects’ master branch.
          * 
          * @param  int      number of commits to go back in time
          * @return array    a list of commits
          */
         private function history($num = 0)
         {
             $master = $this->repo->getObject($this->repo->getTip('master'));
             return array_reverse($master->getHistory());
         }
     }
     
/* End of file changelog.php */
/* Location: ./application/classes/controller/changelog.php */ 