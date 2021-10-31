import React from "react"
import API from '../../API/index'
import { IPost } from '../../types'
import Post from '../Post/Post'

function Posts() {
    const [posts, setPosts] = React.useState<IPost[]>([]);
    React.useEffect(() => {
        API.fetchPosts()
        .then(res => {
            setPosts(res.data)
            console.log(res.data)
          })
          .catch(err => console.log(err))
      }, [])
    return (
        <div>
            {posts.map(post => 
            <Post key={post.id} post={post} />
            )}
        </div>
    )
}

export default Posts
