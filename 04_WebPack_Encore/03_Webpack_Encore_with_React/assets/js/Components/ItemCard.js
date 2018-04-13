import React from 'react';
import { Card, CardHeader, CardTitle, CardText } from 'material-ui/Card';

const ItemCard = ({ author, avatarUrl, title, subtitle, style, children }) => (
  <Card style={style}>
    <CardHeader title={author} avatar={avatarUrl} />
    <CardTitle title={title} subtitle={subtitle} />
    <CardText>{children}</CardText>
  </Card>
);

export default ItemCard;