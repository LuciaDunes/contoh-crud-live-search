<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function search(Request $request)
    {
        if($request->ajax())
        {
            $data = Post::where('id', 'like' . '%' . $request->search . '%')
            ->orwhere('quote', 'like' . '%' .  $request->search . '%')
            ->orwhere('author', 'like' . '%' . $request->search . '%')
            ->get();

            $output = '';
        if (count($data) > 0)
        {
            $output = '
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Quote</th>
                        <th scope="col">Author</th>
                    </tr>
                </thead>

                <tbody>';

                foreach ($data as $row)
                {
                    $output .= '
                    <tr>
                        <th scope="row">'.$row->id.'</th>
                            <td>'.$row->quote.'</td>
                            <td>'.$row->author.'</td>
                    </tr>
                    ';
                }

                $output .= '
                </tbody>
            </table>';

        } else {
            $output .= 'No results';
        }
        return $output;
        }
    }
}

