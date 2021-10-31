import { IPost } from '../../types';

interface PostProps {
  post: IPost
}
function Post({ post }: PostProps) {
  return<div className="mb-5 mt-5 text-center d-flex justify-content-center">
  <div className="card col-4">
    <div className="card-header">
     Title:  {post.title}
    </div>
    <ul className="list-group list-group-flush">
      <li className="list-group-item">Brief Explanation : {post.body} </li>
      <li className="list-group-item">Author : {post.author} </li>
    </ul>
    </div>
  </div>
}

export default Post